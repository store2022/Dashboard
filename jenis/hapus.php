<?php
<<<<<<< Updated upstream
session_start();
include '../koneksi.php';

if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

$id_jenis = $_GET['id'] ?? null;

if ($id_jenis) {
    $stmt = $pdo->prepare("DELETE FROM jenis WHERE id_jenis = ?");
    $stmt->execute([$id_jenis]);

    $_SESSION['success'] = "Jenis deleted successfully!";
}

header('Location: index.php');
exit;
=======
include_once(__DIR__ . '/../koneksi.php');

if(isset($_GET['id'])) {
    try {
        // Menghapus data jenis
        $stmt = $pdo->prepare("DELETE FROM jenis WHERE id_jenis = ?");
        $stmt->execute([$_GET['id']]);
        
        echo "<script>
            alert('Data Berhasil Dihapus');
            window.location.href='../index.php?page=jenis';
        </script>";
    } catch(PDOException $e) {
        echo "<script>
            alert('Gagal menghapus data: Data masih terhubung dengan data lain');
            window.location.href='../index.php?page=jenis';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../index.php?page=jenis';
    </script>";
}
?>
>>>>>>> Stashed changes
