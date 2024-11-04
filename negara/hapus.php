<?php
<<<<<<< Updated upstream
include '../koneksi.php';

if (!isset($pdo)) {
    die("Variabel \$pdo tidak terdefinisi. Pastikan koneksi.php berhasil di-include.");
}

// Query data negara
$stmt = $pdo->query("SELECT * FROM negara");
$negara = $stmt->fetchAll();

// Check if ID is provided
if (isset($_GET['id'])) {
    $id_negara = $_GET['id'];

    // Prepare and execute delete statement
    $stmt = $pdo->prepare("DELETE FROM negara WHERE id_negara = ?");
    $stmt->execute([$id_negara]);

    // Redirect to manage negara page with success message
    $_SESSION['success'] = "Country deleted successfully!";
    header('Location: index.php'); // Redirect to the manage negara page
    exit;
} else {
    // Redirect to manage negara page with error message if ID not found
    $_SESSION['error'] = "Country ID not found!";
    header('Location: index.php');
    exit;
}
?>
=======
include_once(__DIR__ . '/../koneksi.php');

if(isset($_GET['id'])) {
    try {
        // Menghapus data negara
        $stmt = $pdo->prepare("DELETE FROM negara WHERE id_negara = ?");
        $stmt->execute([$_GET['id']]);
        
        echo "<script>
            alert('Data Berhasil Dihapus');
            window.location.href='../index.php?page=negara';
        </script>";
    } catch(PDOException $e) {
        echo "<script>
            alert('Gagal menghapus data: Data masih terhubung dengan data lain');
            window.location.href='../index.php?page=negara';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../index.php?page=negara';
    </script>";
}
?>
>>>>>>> Stashed changes
