<?php
<<<<<<< Updated upstream
try {
    // Sesuaikan `db_name`, `username`, dan `password` dengan pengaturan database Anda
    $pdo = new PDO('mysql:host=localhost;dbname=museum__3_', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
=======
$host = "localhost";
$dbname = "museum__3_";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
>>>>>>> Stashed changes
