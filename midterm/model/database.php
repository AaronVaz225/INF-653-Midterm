<?php 

$dsn = 'mysql:host=ysp9sse09kl0tzxj.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=y6hcj8o8vp0qclaz';
$username = 'bix13ahz4s8w7s6p';
$pass = 'rg7crj9m1w67jfau';

try{
    $db = new PDO($dsn, $username, $pass);

} catch(PDOException $e){
$error = "Database Error: ";
$error .= $e->getMessage();
include('../view/error.php');
exit();

}

