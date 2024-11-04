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
    $id_provinsi = $_GET['id'];

    // Prepare and execute delete statement
    $stmt = $pdo->prepare("DELETE FROM provinsi WHERE id_provinsi = ?");
    $stmt->execute([$id_provinsi]);

    // Redirect to manage provinces page with success message
    $_SESSION['success'] = "Province deleted successfully!";
    header('Location: index.php'); // Redirect to the manage provinces page
    exit;
} else {
    // Redirect to manage provinces page with error message if ID not found
    $_SESSION['error'] = "Province ID not found!";
    header('Location: index.php');
    exit;
}
=======
include_once(__DIR__ . '/../koneksi.php');

if(isset($_GET['id'])) {
    try {
        // Menghapus data provinsi
        $stmt = $pdo->prepare("DELETE FROM provinsi WHERE id_provinsi = ?");
        $stmt->execute([$_GET['id']]);
        
        echo "<script>
            alert('Data Berhasil Dihapus');
            window.location.href='../index.php?page=provinsi';
        </script>";
    } catch(PDOException $e) {
        echo "<script>
            alert('Gagal menghapus data: Data masih terhubung dengan data lain');
            window.location.href='../index.php?page=provinsi';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../index.php?page=provinsi';
    </script>";
}
?>
>>>>>>> Stashed changes
