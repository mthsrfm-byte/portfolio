<?php
// One-time publisher endpoint. The server accepts only an envelope signed by the configured release key.
define('CHAT_PREVIEW',true);
define('DONOTCACHEPAGE',true);
require __DIR__ . '/app.php';
chat_headers();
require dirname(__DIR__,3) . '/wp-load.php';
chat_headers();
if (get_option(CHAT_CONFIG,false) !== false) { http_response_code(404); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input',false,null,0,16385);
    if (!$body || strlen($body)>16384) { http_response_code(413); exit; }
    $package = json_decode($body,true);
    if (!is_array($package) || !is_string($package['sealed'] ?? null) || !is_string($package['signature'] ?? null)) { http_response_code(400); exit; }
    $ok = chat_import_envelope(base64_decode($package['sealed'],true),base64_decode($package['signature'],true));
    http_response_code($ok ? 201 : 403);
    if ($ok) { echo 'Preview initialised.'; }
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'GET') { http_response_code(405); exit; }
$private = chat_setup_key();
if (!$private) { http_response_code(503); exit; }
$public = openssl_pkey_get_details(openssl_pkey_get_private($private));
header('Content-Type: text/plain; charset=utf-8');
echo $public['key'];
