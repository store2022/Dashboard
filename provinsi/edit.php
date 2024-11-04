<?php
include_once(__DIR__ . '/../koneksi.php');

// Fetch the province details
if (isset($_GET['id'])) {
    $id_provinsi = $_GET['id'];

    // Fetch the current province data
    $stmt = $pdo->prepare("SELECT * FROM provinsi WHERE id_provinsi = ?");
    $stmt->execute([$id_provinsi]);
    $province = $stmt->fetch();

    // Check if the province exists
    if (!$province) {
        $_SESSION['error'] = "Provinsi tidak ditemukan!";
        header('Location: ../index.php?page=provinsi');
        exit;
    }

    // Fetch countries for the dropdown
    $stmt = $pdo->query("SELECT * FROM negara");
    $negaras = $stmt->fetchAll();

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_provinsi = $_POST['nama_provinsi'];
        $id_negara = $_POST['id_negara'];

        $error = null;

        // Validasi ID harus diawali dengan P2
        if (empty($nama_provinsi) || empty($id_negara)) {
            $error = "Semua field harus diisi!";
        }

        if ($error === null) {
            try {
                $pdo->beginTransaction();

                    $stmt = $pdo->prepare("UPDATE provinsi SET nama_provinsi = ?, id_negara = ? WHERE id_provinsi = ?");
                    $stmt->execute([$nama_provinsi, $id_negara, $id_provinsi]);

                $pdo->commit();
                $_SESSION['success'] = "Data provinsi berhasil diperbarui!";
                header('Location: ../index.php?page=provinsi');
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = "Gagal memperbarui data: " . $e->getMessage();
            }
        }
    }
} else {
    $_SESSION['error'] = "ID Provinsi tidak ditemukan!";
    header('Location: ../index.php?page=provinsi');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Provinsi</title>
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
                <h2 class="text-center">Edit Provinsi</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label">ID Provinsi</label>
                        <input type="text" class="form-control" id="id_provinsi" name="id_provinsi" 
                               value="<?= htmlspecialchars($province['id_provinsi']) ?>" 
                               disabled>
                    </div>

                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                        <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" 
                               value="<?= htmlspecialchars($province['nama_provinsi']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_negara" class="form-label">Negara</label>
                        <select class="form-control" id="id_negara" name="id_negara" required>
                            <option value="">Pilih Negara</option>
                            <?php foreach ($negaras as $negara): ?>
                                <option value="<?= $negara['id_negara'] ?>" 
                                    <?= $negara['id_negara'] == $province['id_negara'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($negara['nama_negara']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="../index.php?page=provinsi" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>