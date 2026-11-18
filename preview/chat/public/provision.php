<?php
// One-time signed provisioning. Only the public verification key is distributed.
define('CHAT_PREVIEW',true);
require __DIR__ . '/app.php';
chat_headers();
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' || (int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 32768) {
    http_response_code(404); exit;
}
$payload = file_get_contents('php://input',false,null,0,32769);
$signature = base64_decode($_SERVER['HTTP_X_PROPOSAL_SIGNATURE'] ?? '',true);
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
if (strlen($payload) > 32768 || !$signature || openssl_verify($payload,$signature,$public_key,OPENSSL_ALGO_SHA256) !== 1) {
    http_response_code(403); exit;
}
define('DONOTCACHEPAGE',true);
require dirname(__DIR__,3) . '/wp-load.php';
chat_headers();
if (get_option(CHAT_CONFIG,false) !== false) { http_response_code(409); exit; }
$doc = json_decode($payload,true);
if (!is_array($doc) || empty($doc['pin_hash']) || !isset($doc['stages'][2]) || $doc['deposit']+$doc['balance'] !== $doc['amount']) {
    http_response_code(422); exit;
}
if (!chat_schema() || !add_option(CHAT_CONFIG,$doc,'',false)) { http_response_code(503); exit; }
http_response_code(201);
echo 'Preview initialised.';
