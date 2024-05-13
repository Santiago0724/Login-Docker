<?php
    $server = 'db';
    $username = 'root';
    $password = '';
    $database  = 'login_docker';

    try{
        $conn = new  PDO("mysql:host=$server;dbname=$database;", $username, $password);

    }catch(PDOException $e){
        die('Conexion fallida: ' .$e->getMessage());
    }
?>