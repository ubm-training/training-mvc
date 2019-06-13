<?php
function dbOpen() {
    $dbHost = '192.168.10.1:3306';
    $dbUser = 'homestead';
    $dbPass = 'secret';
    $dbName = 'training_mvc';
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if(!$conn){
        die('Could not connect: '.$conn->connect_error);
    }
    return $conn;
}
