<?php

echo <<<EOT
What do you want to do?:

1. Encrypt
2. Decrypt
EOT . PHP_EOL;

$option = (int) strtolower(readline('=> '));
$option = ($option == 2) ? 'decrypt' : 'encrypt' ;

$input = readline("Input: ");

$input = encrypt_decrypt('encrypt', $input);
echo $input;

function encrypt_decrypt($action, $string) 
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'hVmYq3t6w9z$C&F)';
        $secret_iv = 'gUkXp2s5';
        // hash
        $key = hash('sha256', $secret_key);    
        // iv - encrypt method AES-256-CBC expects 16 bytes 
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }