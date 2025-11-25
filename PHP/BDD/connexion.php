<?php
    global $pdo;

    try {
    $pdo = new PDO('mysql:host=localhost ;dbname=dx09_bd', 'dx09', 'ahrohm0xieRaeg4t');;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

?>