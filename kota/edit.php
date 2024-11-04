<?php
include_once(__DIR__ . '/../koneksi.php');

// Fetch the city details
if (isset($_GET['id'])) {
    $id_kota = $_GET['id'];

    // Fetch the current city data
    $stmt = $pdo->prepare("SELECT * FROM kota WHERE id_kota = ?");
    $stmt->execute([$id_kota]);
    $kota = $stmt->fetch();

    // Check if the city exists
    if (!$kota) {
        $_SESSION['error'] = "Kota tidak ditemukan!";
        header('Location: ../index.php?page=kota');
        exit;
    }

    // Fetch provinces for the dropdown
    $stmt = $pdo->query("SELECT * FROM provinsi");
    $provinsis = $stmt->fetchAll();

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_kota = trim($_POST['nama_kota']);
        $id_provinsi = trim($_POST['id_provinsi']);

        $error = null;

        // Validasi ID harus diawali dengan K 4
        if (empty($nama_kota) || empty($id_provinsi)) {
            $error = "Semua field harus diisi!";
        }

        if ($error === null) {
            try {
                $pdo->beginTransaction();

                // Update the city data
                $stmt = $pdo->prepare("UPDATE kota SET nama_kota = ?, id_provinsi = ? WHERE id_kota = ?");
                $stmt->execute([$nama_kota, $id_provinsi, $id_kota]);

                $_SESSION['success'] = "Data kota berhasil diperbarui!";
                header('Location: ../index.php?page=kota');
                exit;
            } catch (Exception $e) {
                $error = "Gagal memperbarui data: " . $e->getMessage();
            }
        }
    }
} else {
    $_SESSION['error'] = "ID Kota tidak ditemukan!";
    header('Location: ../index.php?page=kota');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: white;
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
                <h2 class="text-center mb-0">Edit Kota</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="id_kota" class="form-label">ID Kota</label>
                        <input type="text" class="form-control" id="id_kota" name="id_kota" 
                               value="<?= htmlspecialchars($kota['id_kota']) ?>" 
                               disabled>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kota" class="form-label">Nama Kota</label>
                        <input type="text" class="form-control" id="nama_kota" name="nama_kota" 
                               value="<?= htmlspecialchars($kota['nama_kota']) ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" id="id_provinsi" name="id_provinsi" required>
                            <option value="">Pilih Provinsi</option>
                            <?php foreach($provinsis as $provinsi): ?>
                                <option value="<?= htmlspecialchars($provinsi['id_provinsi']) ?>"
                                    <?= ($kota['id_provinsi'] == $provinsi['id_provinsi']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($provinsi['nama_provinsi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="../index.php?page=kota" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>