<?php

$connection = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'app'
];

$mysqli = new mysqli(
  $connection['host'],
  $connection['user'],
  $connection['password'],
  $connection['database']
 );

if($mysqli->connect_error){
    die("خطاء بالاتصال بقاعده البيانات " . $mysqli->connect_error);
}
 ?>
