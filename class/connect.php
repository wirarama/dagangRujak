<?php
$host = 'localhost';
$db = 'kependudukanDesa';
$user = 'desa';
$pass = 'desaBali';
$char = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$char";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn,$user,$pass,$opt);
$dir = '../uploads/';
$pathUsr = '/mine/kependudukanDesa/';
$dirUsr = $pathUsr.'uploads/';
//echo getcwd() . "\n";