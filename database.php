<?php 
    $server = 'localhost';
    $username ='root';
    $password = '';
    $database = 'pokedex_php_database';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
        } catch (PDOException $e) {
        die('Connected failed: '.$e->getMessage());
    }
?>