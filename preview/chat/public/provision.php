<?php
// Export only the preview's public provisioning key. Deployment carries the sealed, signed document over FTPS.
define('CHAT_PREVIEW',true);
define('DONOTCACHEPAGE',true);
require __DIR__ . '/app.php';
chat_headers();
require dirname(__DIR__,3) . '/wp-load.php';
chat_headers();
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || get_option(CHAT_CONFIG,false) !== false) { http_response_code(404); exit; }
$private = chat_setup_key();
if (!$private) { http_response_code(503); exit; }
$public = openssl_pkey_get_details(openssl_pkey_get_private($private));
header('Content-Type: text/plain; charset=utf-8');
echo $public['key'];
