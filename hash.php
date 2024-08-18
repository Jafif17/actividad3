<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$password = 'Progweb2#'; 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>
