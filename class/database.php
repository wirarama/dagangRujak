<?php
include 'connect.php';
class database{
    private $host = HOST;
    private $db   = DB;
    private $user = USER;
    private $pass = PASS;
    private $char = CHAR;
    function connect(){
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->char";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn,$this->user,$this->pass,$opt);
        return $pdo;
    }
}