<?php
include_once(__DIR__ . '/../koneksi.php');

// Fetch the country details
if (isset($_GET['id'])) {
    $id_jenis = $_GET['id'];

    // Fetch the current country data
    $stmt = $pdo->prepare("SELECT * FROM jenis WHERE id_jenis = ?");
    $stmt->execute([$id_jenis]);
    $jenis = $stmt->fetch();

    // Check if the country exists
    if (!$jenis) {
        $_SESSION['error'] = "jenis tidak ditemukan!";
        header('Location: ../index.php?page=jenis');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_jenis = trim($_POST['nama_jenis']);

        $error = null;

        if (empty($nama_jenis)) {
            $error = "Semua field harus diisi!";
        }

        if ($error === null) {
            try {
                $pdo->beginTransaction();

                
                    // Update the country data without changing ID
                $stmt = $pdo->prepare("UPDATE jenis SET nama_jenis = ? WHERE id_jenis = ?");
                $stmt->execute([$nama_jenis, $id_jenis]);

                $pdo->commit();
                $_SESSION['success'] = "Data negara berhasil diperbarui!";
                header('Location: ../index.php?page=jenis');
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = "Gagal memperbarui data: " . $e->getMessage();
            }
        }
    }
} else {
    $_SESSION['error'] = "ID jenis tidak ditemukan!";
    header('Location: ../index.php?page=jenis');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit jenis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
        }
        .card {
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
        }
        .btn-action {
            width: 100%;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Edit jenis</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="id_jenis" class="form-label">ID jenis</label>
                        <input type="text" class="form-control" id="id_jenis" name="id_jenis" 
                               value="<?= htmlspecialchars($jenis['id_jenis']) ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="nama_jenis" class="form-label">Nama jenis</label>
                        <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" 
                               value="<?= htmlspecialchars($jenis['nama_jenis']) ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="../index.php?page=jenis" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>