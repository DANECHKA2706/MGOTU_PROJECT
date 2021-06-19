<?php
session_start();
$login = $_SESSION['logined'];
$configargs = array(
  "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
  'private_key_bits'=> 1024,
  'default_md' => "sha256",
);

$res = openssl_pkey_new($configargs);
openssl_pkey_export($res, $privKey,NULL,$configargs);
echo $privKey;

$connection = mysqli_connect('localhost', 'root', '', 'user_data');
$select_query = "SELECT * FROM users WHERE token = '$privKey';";
$select_query_result = mysqli_query($connection, $select_query);

if(mysqli_num_rows($select_query_result) > 0){
  echo "Ключ уже создан";
}else {
  $query = "INSERT INTO users (token) VALUES ('$privKey')";
}

// $pubKey = openssl_pkey_get_details($res);
// $pubKey = $pubKey["key"];
// echo $pubKey;
?>