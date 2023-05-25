<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=dbjessamine', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
