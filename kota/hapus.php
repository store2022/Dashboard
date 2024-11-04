<?php
<<<<<<< Updated upstream
session_start();
include '../koneksi.php';

// Check if the user is authorized
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id_kota = $_GET['id'];

    // Prepare and execute delete statement
    $stmt = $pdo->prepare("DELETE FROM kota WHERE id_kota = ?");
    $stmt->execute([$id_kota]);

    $_SESSION['success'] = "City deleted successfully!";
    header('Location: index.php'); // Redirect to manage cities page
    exit;
} else {
    $_SESSION['error'] = "City ID not found!";
    header('Location: index.php');
    exit;
}
=======
include_once(__DIR__ . '/../koneksi.php');

if(isset($_GET['id'])) {
    try {
        // Menghapus data kota
        $stmt = $pdo->prepare("DELETE FROM kota WHERE id_kota = ?");
        $stmt->execute([$_GET['id']]);
        
        echo "<script>
            alert('Data Berhasil Dihapus');
            window.location.href='../index.php?page=kota';
        </script>";
    } catch(PDOException $e) {
        echo "<script>
            alert('Gagal menghapus data: Data masih terhubung dengan data lain');
            window.location.href='../index.php?page=kota';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../index.php?page=kota';
    </script>";
}
?>
>>>>>>> Stashed changes
