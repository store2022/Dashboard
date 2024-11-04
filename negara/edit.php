<?php
include_once(__DIR__ . '/../koneksi.php');

// Fetch the country details
if (isset($_GET['id'])) {
    $id_negara = $_GET['id'];

    // Fetch the current country data
    $stmt = $pdo->prepare("SELECT * FROM negara WHERE id_negara = ?");
    $stmt->execute([$id_negara]);
    $negara = $stmt->fetch();

    // Check if the country exists
    if (!$negara) {
        $_SESSION['error'] = "Negara tidak ditemukan!";
        header('Location: ../index.php?page=negara');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_negara = trim($_POST['nama_negara']);

        $error = null;

        if (empty($nama_negara)) {
            $error = "Semua field harus diisi!";
        }

        if ($error === null) {
            try {
                $pdo->beginTransaction();

                    $stmt = $pdo->prepare("UPDATE negara SET nama_negara = ? WHERE id_negara = ?");
                    $stmt->execute([$nama_negara, $id_negara]);

                $pdo->commit();
                $_SESSION['success'] = "Data negara berhasil diperbarui!";
                header('Location: ../index.php?page=negara');
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = "Gagal memperbarui data: " . $e->getMessage();
            }
        }
    }
} else {
    $_SESSION['error'] = "ID Negara tidak ditemukan!";
    header('Location: ../index.php?page=negara');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Negara</title>
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
                <h2 class="text-center">Edit Negara</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="id_negara" class="form-label">ID Negara</label>
                        <input type="text" class="form-control" id="id_negara" name="id_negara" 
                               value="<?= htmlspecialchars($negara['id_negara']) ?>" 
                               disabled>
                    </div>

                    <div class="mb-3">
                        <label for="nama_negara" class="form-label">Nama Negara</label>
                        <input type="text" class="form-control" id="nama_negara" name="nama_negara" 
                               value="<?= htmlspecialchars($negara['nama_negara']) ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="../index.php?page=negara" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>