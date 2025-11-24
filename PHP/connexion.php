<?php
    global $pdo;
    $pdo = new PDO('mysql:host=localhost ;dbname=dx09_bd', 'dx09', 'ahrohm0xieRaeg4t');

    try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

?>