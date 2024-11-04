<?php
session_start();
<<<<<<< Updated upstream
include '../koneksi.php';

// Periksa apakah pengguna terotorisasi
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

// Ambil negara untuk dropdown
$stmt = $pdo->query("SELECT * FROM negara");
$negaras = $stmt->fetchAll();

$error_message = ""; // Variabel untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_provinsi = $_POST['id_provinsi'];
    $nama_provinsi = $_POST['nama_provinsi'];
    $id_negara = $_POST['id_negara'];

    // Periksa apakah ID provinsi sudah ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM provinsi WHERE id_provinsi = ?");
    $stmt->execute([$id_provinsi]);
    $exists_id = $stmt->fetchColumn();

    // Periksa apakah nama provinsi sudah ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM provinsi WHERE nama_provinsi = ?");
    $stmt->execute([$nama_provinsi]);
    $exists_name = $stmt->fetchColumn();

    if ($exists_id > 0) {
        $error_message = "ID Provinsi sudah ada. Silakan gunakan ID yang berbeda.";
    } elseif ($exists_name > 0) {
        $error_message = "Nama Provinsi sudah ada. Silakan gunakan nama yang berbeda.";
    } else {
        // Sisipkan provinsi ke dalam database
        $stmt = $pdo->prepare("INSERT INTO provinsi (id_provinsi, nama_provinsi, id_negara) VALUES (?, ?, ?)");
        $stmt->execute([$id_provinsi, $nama_provinsi, $id_negara]);

        $_SESSION['success'] = "Provinsi berhasil ditambahkan!";
        header('Location: index.php'); // Redirect ke halaman kelola provinsi
        exit;
=======
require_once '../koneksi.php';

// Query untuk mengambil data negara
try {
    $query_negara = "SELECT * FROM negara";
    $stmt = $pdo->query($query_negara);
    $result_negara = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Proses tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_provinsi = trim($_POST['id_provinsi']);
    $nama_provinsi = trim($_POST['nama_provinsi']);
    $id_negara = trim($_POST['id_negara']);

    // Validasi input tidak boleh kosong
    if (empty($id_provinsi) || empty($nama_provinsi) || empty($id_negara)) {
        $error = "Semua field harus diisi!";
    } 
    // Validasi ID harus diawali dengan P2
    elseif (substr($id_provinsi, 0, 2) !== 'P2') {
        $error = "ID Provinsi harus diawali dengan 'P2'!";
    }
    // Validasi panjang ID maksimal 4 karakter
    elseif (strlen($id_provinsi) > 4) {
        $error = "ID Provinsi tidak boleh lebih dari 4 karakter!";
    }
    else {
        try {
            // Cek apakah ID provinsi sudah ada
            $check_id = $pdo->prepare("SELECT COUNT(*) FROM provinsi WHERE id_provinsi = ?");
            $check_id->execute([$id_provinsi]);
            $id_exists = $check_id->fetchColumn();

            // Cek apakah nama provinsi sudah ada
            $check_nama = $pdo->prepare("SELECT COUNT(*) FROM provinsi WHERE nama_provinsi = ?");
            $check_nama->execute([$nama_provinsi]);
            $nama_exists = $check_nama->fetchColumn();

            if ($id_exists) {
                $error = "ID Provinsi sudah ada dalam database!";
            } 
            elseif ($nama_exists) {
                $error = "Nama provinsi sudah ada dalam database!";
            }
            else {
                // Insert data baru
                $stmt = $pdo->prepare("INSERT INTO provinsi (id_provinsi, nama_provinsi, id_negara) VALUES (?, ?, ?)");
                $stmt->execute([$id_provinsi, $nama_provinsi, $id_negara]);
                
                $_SESSION['success'] = "Data provinsi berhasil ditambahkan!";
                header('Location: ../index.php?page=provinsi');
                exit;
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
>>>>>>> Stashed changes
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<<<<<<< Updated upstream

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        h1 {
            color: #007bff;
        }
        .table {
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-warning, .btn-danger {
            color: white;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
    <title>Tambah Provinsi</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Provinsi</h1>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
            <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_provinsi">ID Provinsi</label>
                <input type="text" class="form-control" id="id_provinsi" name="id_provinsi" placeholder="ID provinsi" maxlength="4" value="P2" required>
                <label for="nama_provinsi">Nama Provinsi</label>
                <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" placeholder="Nama provinsi" required>
            </div>
            <div class="form-group">
                <label for="id_negara">Negara</label>
                <select class="form-control" id="id_negara" name="id_negara" required>
                    <option value="">Pilih Negara</option>
                    <?php foreach ($negaras as $negara): ?>
                        <option value="<?= $negara['id_negara'] ?>"><?= htmlspecialchars($negara['nama_negara']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Provinsi</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Provinsi</title>
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
                <h2 class="text-center mb-0">Tambah Provinsi</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label">ID Provinsi</label>
                        <input type="text" class="form-control" id="id_provinsi" name="id_provinsi" 
                               value="<?= isset($_POST['id_provinsi']) ? htmlspecialchars($_POST['id_provinsi']) : 'P2' ?>" 
                               required maxlength="4">
                        <small class="text-muted">ID harus diawali dengan P2 dan maksimal 4 karakter</small>
                    </div>

                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                        <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" 
                               value="<?= isset($_POST['nama_provinsi']) ? htmlspecialchars($_POST['nama_provinsi']) : '' ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="id_negara" class="form-label">Negara</label>
                        <select class="form-select" id="id_negara" name="id_negara" required>
                            <option value="">Pilih Negara</option>
                            <?php foreach($result_negara as $negara): ?>
                                <option value="<?= htmlspecialchars($negara['id_negara']) ?>"
                                    <?= (isset($_POST['id_negara']) && $_POST['id_negara'] == $negara['id_negara']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($negara['nama_negara']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="../index.php?page=provinsi" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
>>>>>>> Stashed changes
</html>