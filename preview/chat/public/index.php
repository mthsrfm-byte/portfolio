<?php
define('CHAT_PREVIEW',true);
define('DONOTCACHEPAGE',true);
require __DIR__ . '/app.php';
chat_headers();
require dirname(__DIR__,3) . '/wp-load.php';
chat_headers();
$doc = get_option(CHAT_CONFIG,false);
if ($doc === false) { $doc = chat_install_package(); }
if (!is_array($doc)) { http_response_code(503); echo 'This private preview is being prepared.'; exit; }
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if (!in_array($method,['GET','HEAD','POST'],true)) { header('Allow: GET, HEAD, POST'); http_response_code(405); exit; }
chat_session();
$error = '';
$error_area = 'gate';
$message = $_SESSION['notice'] ?? '';
unset($_SESSION['notice']);
$authorised = ($_SESSION['until'] ?? 0) > time() && ($_SESSION['version'] ?? '') === $doc['version'];
if (!$authorised) { unset($_SESSION['until'],$_SESSION['version'],$_SESSION['question_key']); }
if ($method === 'POST') {
    $action = chat_value('action');
    $error_area = $authorised ? ($action === 'question' ? 'question' : 'accept') : 'gate';
    if ((int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 16384) {
        $error = 'This submission is too long.'; http_response_code(413);
    } elseif (!hash_equals($_SESSION['csrf'],chat_value('csrf'))) {
        $error = 'Your session changed. Please try again using this page.'; http_response_code(403);
    } elseif ($action === 'unlock') {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        if (!chat_limit('gate-session',5,900,session_id()) || !chat_limit('gate-network',15,900,$ip)) {
            $error = 'Too many attempts. Please try again in 15 minutes.'; header('Retry-After: 900'); http_response_code(429);
        } elseif (!preg_match('/^[0-9]{4}$/D',chat_value('code')) || !password_verify(chat_value('code'),$doc['pin_hash'])) {
            $error = 'That code doesn’t match. Please try again.'; http_response_code(401);
        } else {
            session_regenerate_id(true);
            $_SESSION = ['csrf'=>bin2hex(random_bytes(32)), 'until'=>time()+CHAT_TTL, 'version'=>$doc['version']];
            chat_redirect();
        }
    } elseif (!$authorised) {
        $error = 'Your session has ended. Enter your access code to continue.'; http_response_code(401);
    } elseif ($action === 'lock') {
        $_SESSION = [];
        session_destroy();
        setcookie('sera_chat_preview','',['expires'=>1,'path'=>CHAT_PATH,'secure'=>true,'httponly'=>true,'samesite'=>'Strict']);
        chat_redirect();
    } elseif (in_array($action,['accept','question'],true)) {
        $email = chat_value('email');
        $name = sanitize_text_field(chat_value('full_name'));
        $question = sanitize_textarea_field(chat_value('question'));
        if (chat_value('version') !== $doc['version'] || chat_value('proposal') !== $doc['id']) {
            $error = 'The proposal has changed. Review this version before responding.';
        } elseif (strlen($email) > 254 || !is_email($email)) {
            $error = 'Enter a valid work email.';
        } elseif (strlen($name) > 130) {
            $error = 'Use a shorter name, up to 130 characters.';
        } elseif ($action === 'accept' && chat_value('confirmed') !== 'yes') {
            $error = 'Select the confirmation box to accept the proposal.';
        } elseif ($action === 'question' && ($question === '' || preg_match_all('/./us',$question) > 2000)) {
            $error = 'Enter a message of up to 2,000 characters.';
        } elseif ($action === 'question' && !preg_match('/^[a-f0-9]{32}$/D',chat_value('request'))) {
            $error = 'Refresh the page and send your message again.';
        }
        if ($error !== '') { http_response_code(422); }
        elseif (!chat_limit('write-session',12,600,session_id()) || !chat_limit('write-network',35,600,$_SERVER['REMOTE_ADDR'] ?? 'unknown')) {
            $error = 'Too many submissions. Please try again in 10 minutes.'; http_response_code(429);
        } else {
            $record = chat_store($doc,$action,$email,$action === 'accept' ? $name : '',$action === 'question' ? $question : '',chat_value('request'));
            if (!$record) {
                $error = 'We couldn’t save this response. Your details are still here. Please try again.'; http_response_code(503);
            } else {
                $_SESSION['notice'] = $action;
                if ($action === 'question') { unset($_SESSION['question_key']); }
                chat_deliver_pending();
                chat_redirect('#respond');
            }
        }
    } else { http_response_code(400); $error = 'Choose an action from this page.'; }
}
if ($authorised) {
    if (empty($_SESSION['question_key'])) { $_SESSION['question_key'] = bin2hex(random_bytes(16)); }
    if ($method === 'GET') { chat_deliver_pending(); }
}
require __DIR__ . '/view.php';
