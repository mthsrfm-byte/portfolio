<?php
// Internal functions. This file is included by the two preview entry points.
if (!defined('CHAT_PREVIEW')) { http_response_code(404); exit; }
const CHAT_CONFIG = 'sera_chat_preview_document_v1';
const CHAT_PATH = '/chat/comercial/evenly/';
const CHAT_TTL = 1800;

function chat_headers() {
    header('Content-Type: text/html; charset=UTF-8');
    header('Cache-Control: private, no-store, max-age=0, must-revalidate');
    header('Pragma: no-cache');
    header('Vary: Cookie', false);
    header('X-Robots-Tag: noindex, nofollow, noarchive, nosnippet');
    header('Referrer-Policy: no-referrer');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header("Content-Security-Policy: default-src 'none'; style-src 'self'; script-src 'self'; img-src 'self' data:; font-src 'self'; form-action 'self'; frame-ancestors 'none'; base-uri 'none'");
}

function chat_tables() {
    global $wpdb;
    return [$wpdb->prefix . 'sera_chat_preview_records', $wpdb->prefix . 'sera_chat_preview_limits'];
}

function chat_schema() {
    global $wpdb;
    [$records, $limits] = chat_tables();
    $charset = $wpdb->get_charset_collate();
    $records_sql = "CREATE TABLE IF NOT EXISTS $records (
        id char(36) NOT NULL PRIMARY KEY,
        request_key char(64) NOT NULL UNIQUE,
        kind varchar(12) NOT NULL,
        proposal_id varchar(96) NOT NULL,
        version varchar(48) NOT NULL,
        email varchar(254) NOT NULL,
        full_name varchar(130) NOT NULL,
        message text NOT NULL,
        confirmed tinyint(1) NOT NULL,
        terms longtext NOT NULL,
        created_utc datetime NOT NULL,
        notify_status varchar(16) NOT NULL,
        next_notify datetime NOT NULL,
        INDEX notification_queue (notify_status,next_notify)
    ) $charset";
    $limits_sql = "CREATE TABLE IF NOT EXISTS $limits (
        bucket char(64) NOT NULL PRIMARY KEY, hits int NOT NULL, expires_at bigint NOT NULL,
        INDEX expiry (expires_at)
    ) $charset";
    return $wpdb->query($records_sql) !== false && $wpdb->query($limits_sql) !== false;
}

function chat_session() {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_cache_limiter('');
    session_name('sera_chat_preview');
    session_set_cookie_params(['lifetime'=>CHAT_TTL, 'path'=>CHAT_PATH, 'secure'=>true, 'httponly'=>true, 'samesite'=>'Strict']);
    session_start();
    if (!isset($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }
}

function chat_value($key) {
    return isset($_POST[$key]) && is_string($_POST[$key]) ? trim(wp_unslash($_POST[$key])) : '';
}

function chat_limit($purpose, $max, $seconds, $identity) {
    global $wpdb;
    [, $table] = chat_tables();
    $now = time();
    $window = intdiv($now, $seconds);
    $key = hash_hmac('sha256', $purpose . '|' . $window . '|' . $identity, wp_salt('nonce'));
    $result = $wpdb->query($wpdb->prepare(
        "INSERT INTO $table (bucket,hits,expires_at) VALUES (%s,1,%d)
         ON DUPLICATE KEY UPDATE hits=hits+1", $key, ($window+1)*$seconds
    ));
    if ($result === false) { return false; }
    $hits = (int)$wpdb->get_var($wpdb->prepare("SELECT hits FROM $table WHERE bucket=%s",$key));
    $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE expires_at < %d LIMIT 100",$now));
    return $hits > 0 && $hits <= $max;
}

function chat_price($cents, $fraction = false) {
    return '$' . number_format($cents / 100, $fraction ? 2 : 0, '.', ',');
}

function chat_store($doc, $kind, $email, $name, $message, $request) {
    global $wpdb;
    [$table] = chat_tables();
    // The signed preview is reusable. Each test email can accept each version once.
    $scope = $doc['id'] . '|' . $doc['version'] . '|' . $kind . '|' . strtolower($email);
    $key = hash('sha256', $scope . ($kind === 'question' ? '|' . $request : ''));
    $id = wp_generate_uuid4();
    $terms = $doc;
    unset($terms['pin_hash']);
    $saved = $wpdb->query($wpdb->prepare(
        "INSERT INTO $table (id,request_key,kind,proposal_id,version,email,full_name,message,confirmed,terms,created_utc,notify_status,next_notify)
         VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%d,%s,UTC_TIMESTAMP(),'pending',UTC_TIMESTAMP())
         ON DUPLICATE KEY UPDATE request_key=VALUES(request_key)",
        $id,$key,$kind,$doc['id'],$doc['version'],$email,$name,$message,$kind === 'accept' ? 1 : 0,
        $kind === 'accept' ? wp_json_encode($terms) : '{}'
    ));
    if ($saved === false) { return false; }
    return $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE request_key=%s",$key));
}

function chat_deliver_pending() {
    global $wpdb;
    [$table] = chat_tables();
    $row = $wpdb->get_row("SELECT * FROM $table WHERE notify_status IN ('pending','sending') AND next_notify <= UTC_TIMESTAMP() ORDER BY next_notify LIMIT 1");
    if (!$row) { return; }
    $claimed = $wpdb->query($wpdb->prepare(
        "UPDATE $table SET notify_status='sending', next_notify=DATE_ADD(UTC_TIMESTAMP(), INTERVAL 10 MINUTE)
         WHERE id=%s AND next_notify <= UTC_TIMESTAMP() AND notify_status IN ('pending','sending')", $row->id));
    if ($claimed !== 1) { return; }
    $recipient = function_exists('sera_mod') ? sera_mod('contact_email') : get_option('admin_email');
    $action = $row->kind === 'accept' ? 'Acceptance' : 'Question';
    $body = "Test submission from your private portfolio preview.\n\nRecord: $row->id\nProposal: $row->proposal_id ($row->version)\nUTC: $row->created_utc\nEmail: $row->email\nName: $row->full_name\n";
    if ($row->kind === 'accept') {
        $terms = json_decode($row->terms, true);
        $body .= "\nConfirmed the scoped " . $terms['service'] . ' at ' . chat_price($terms['amount']) . ' ' . $terms['currency'] . ', with two instalments of ' . chat_price($terms['deposit'],true) . '.';
    } else { $body .= "\nQuestion:\n" . $row->message; }
    try {
        $sent = is_email($recipient) && wp_mail($recipient, '[Portfolio preview] ' . $action . ' test', $body);
    } catch (Throwable $exception) { $sent = false; }
    $wpdb->update($table,['notify_status'=>$sent ? 'sent' : 'pending'],['id'=>$row->id],['%s'],['%s']);
}

function chat_redirect($fragment = '') {
    header('Location: ' . CHAT_PATH . $fragment, true, 303);
    exit;
}

function chat_setup_key() {
    $name = 'sera_chat_preview_setup_private';
    $saved = get_option($name, false);
    if ($saved) { return $saved; }
    $key = openssl_pkey_new(['private_key_type'=>OPENSSL_KEYTYPE_RSA,'private_key_bits'=>2048]);
    if (!$key || !openssl_pkey_export($key,$private)) { return false; }
    add_option($name,$private,'',false);
    return get_option($name,false);
}

// The package contains no plaintext commercial details. It can only be opened by this WordPress installation.
function chat_install_package() {
    $package_file = __DIR__ . '/sealed.php';
    if (!is_file($package_file)) { return false; }
    $package = require $package_file;
    $ciphertext = base64_decode($package['sealed'],true);
    $signature = base64_decode($package['signature'],true);
    $public_key = <<<'KEY'
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqpHt2p9ddlsrBEziV1JT
6RjL5DlK/jv4bHd1SEAo/fASLuVe3rytmO1FpWlAPyUzd2wISrU+9hknLunEwLVZ
0+Qp6soGFc809c3vRD/FdS/zftL0mn2g9H2+FT6DOW6vQ0i87+PatYO7Ocvnmm0W
kWi5aooShyUs3KjQC329DQP9Nz1A80AxYkaxnW6nAnSZs5Prv2KhDdA54/VJ3cm1
R9eO5toHy6PXKCuu0QiizQeDn21jB+InydenVlPRnSNDyUmDEPWBuSSA/bXa7Rjx
Wy5CWULxdRtYiOUpZ74uqlnxcLpdtzqmznB/69vvVB7GLrU34eXbZ3t615jdC2Pk
hwIDAQAB
-----END PUBLIC KEY-----
KEY;
    if (!$ciphertext || !$signature || openssl_verify($ciphertext,$signature,$public_key,OPENSSL_ALGO_SHA256) !== 1) { return false; }
    $key = get_option('sera_chat_preview_setup_private',false);
    if (!$key || strlen($ciphertext) < 285) { return false; }
    if (!openssl_private_decrypt(substr($ciphertext,0,256),$aes,$key,OPENSSL_PKCS1_OAEP_PADDING)) { return false; }
    $payload = openssl_decrypt(substr($ciphertext,284),'aes-256-gcm',$aes,OPENSSL_RAW_DATA,substr($ciphertext,256,12),substr($ciphertext,268,16));
    $doc = $payload ? json_decode($payload,true) : null;
    if (!is_array($doc) || empty($doc['pin_hash']) || !isset($doc['stages'][2]) || $doc['deposit']+$doc['balance'] !== $doc['amount']) { return false; }
    if (!chat_schema()) { return false; }
    add_option(CHAT_CONFIG,$doc,'',false);
    $saved = get_option(CHAT_CONFIG,false);
    if ($saved) { delete_option('sera_chat_preview_setup_private'); }
    return $saved;
}
