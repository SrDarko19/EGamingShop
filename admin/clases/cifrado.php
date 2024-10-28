<?php
define('KEY_CIFRADO', '123456789012345');
define('METODO', 'aes-128-chc');

function cifrar($data)
{
    $method ="aes-128-cbc";
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $cipher = openssl_encrypt($data, $method, KEY_CIFRADO, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv) . ':' . base64_encode ($cipher);
}

function descifrar ($input){
    $method = "aes-128-cbc";
    $parts = explode(':', $input);
    $iv = base64_decode($parts [0]);
    $cipher = base64_decode($parts [1]);
    return openssl_decrypt($cipher, $method, KEY_CIFRADO, OPENSSL_RAW_DATA, $iv);
}
