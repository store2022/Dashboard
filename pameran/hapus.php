<?php
include_once(__DIR__ . '/../koneksi.php');

if(isset($_GET['id'])) {
    try {
        // Menghapus data pameran
        $stmt = $pdo->prepare("DELETE FROM pameran WHERE id_pameran = ?");
        $stmt->execute([$_GET['id']]);
        
        echo "<script>
            alert('Data Berhasil Dihapus');
            window.location.href='../index.php?page=pameran';
        </script>";
    } catch(PDOException $e) {
        echo "<script>
            alert('Gagal menghapus data: Data masih terhubung dengan data lain');
            window.location.href='../index.php?page=pameran';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href='../index.php?page=pameran';
    </script>";
}
?>