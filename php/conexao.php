<?php

$host = 'localhost:3306';
$db = 'clinica';
$user = 'root';
$pass = 'root';


try {

    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $pdo->exec("SET NAMES utf8");



} catch (PDOException $e) {

    echo 'Erro: ' . $e->getMessage();
}
?>
