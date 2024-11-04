<?php
session_start();
<<<<<<< Updated upstream
include '../koneksi.php';

// Check if the user is authorized
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

// Fetch provinces for the dropdown
$stmt = $pdo->query("SELECT * FROM provinsi");
$provinces = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kota = $_POST['id_kota'];
    $nama_kota = $_POST['nama_kota'];
    $id_provinsi = $_POST['id_provinsi'];

    // Insert city into database
    $stmt = $pdo->prepare("INSERT INTO kota (id_kota, nama_kota, id_provinsi) VALUES (?, ?, ?)");
    $stmt->execute([$id_kota, $nama_kota, $id_provinsi]);

    $_SESSION['success'] = "City added successfully!";
    header('Location: tambah.php'); // Redirect to manage cities page
    exit;
=======
require_once '../koneksi.php';

// Query untuk mengambil data provinsi
try {
    $query_provinsi = "SELECT * FROM provinsi";
    $stmt = $pdo->query($query_provinsi);
    $result_provinsi = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Proses tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kota = trim($_POST['id_kota']);
    $nama_kota = trim($_POST['nama_kota']);
    $id_provinsi = trim($_POST['id_provinsi']);

    // Validasi input tidak boleh kosong
    if (empty($id_kota) || empty($nama_kota) || empty($id_provinsi)) {
        $error = "Semua field harus diisi!";
    } 
    // Validasi ID harus diawali dengan K1
    elseif (substr($id_kota, 0, 2) !== 'K1') {
        $error = "ID Kota harus diawali dengan 'K1'!";
    }
    // Validasi panjang ID harus tepat 4 karakter
    elseif (strlen($id_kota) !== 4) {
        $error = "ID Kota harus tepat 4 karakter!";
    }
    else {
        try {
            // Cek apakah ID kota sudah ada
            $check_id = $pdo->prepare("SELECT COUNT(*) FROM kota WHERE id_kota = ?");
            $check_id->execute([$id_kota]);
            $id_exists = $check_id->fetchColumn();

            // Cek apakah nama kota sudah ada
            $check_nama = $pdo->prepare("SELECT COUNT(*) FROM kota WHERE nama_kota = ?");
            $check_nama->execute([$nama_kota]);
            $nama_exists = $check_nama->fetchColumn();

            if ($id_exists) {
                $error = "ID Kota sudah ada dalam database!";
            } 
            elseif ($nama_exists) {
                $error = "Nama kota sudah ada dalam database!";
            }
            else {
                // Insert data baru
                $stmt = $pdo->prepare("INSERT INTO kota (id_kota, nama_kota, id_provinsi) VALUES (?, ?, ?)");
                $stmt->execute([$id_kota, $nama_kota, $id_provinsi]);
                
                $_SESSION['success'] = "Data kota berhasil ditambahkan!";
                header('Location: ../index.php?page=kota');
                exit;
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
>>>>>>> Stashed changes
}
?>

<!DOCTYPE html>
<<<<<<< Updated upstream
<html lang="en">

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
    </style>
    <title>Add City</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Add City</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_kota">City Id</label>
                <input type="text" class="form-control" id="id_kota" name="id_kota"  placeholder="id_kota" value="K1" required>
                <label for="nama_kota">City Name</label>
                <input type="text" class="form-control" id="nama_kota" name="nama_kota" placeholder="nama_kota" required>
            </div>
            <div class="form-group">
                <label for="id_provinsi">Province</label>
                <select class="form-control" id="id_provinsi" name="id_provinsi" placeholder="id_provinsi" required>
                    <option value="">Select Province</option>
                    <?php foreach ($provinces as $province): ?>
                        <option value="<?= $province['id_provinsi'] ?>"><?= htmlspecialchars($province['nama_provinsi']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add City</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

=======
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kota</title>
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
                <h2 class="text-center mb-0">Tambah Kota</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="id_kota" class="form-label">ID Kota</label>
                        <input type="text" class="form-control" id="id_kota" name="id_kota" 
                               value="<?= isset($_POST['id_kota']) ? htmlspecialchars($_POST['id_kota']) : 'K1' ?>" 
                               required maxlength="4" pattern="K1[0-9A-Za-z]{2}">
                        <small class="text-muted">ID harus diawali dengan K1 dan tepat 4 karakter</small>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kota" class="form-label">Nama Kota</label>
                        <input type="text" class="form-control" id="nama_kota" name="nama_kota" 
                               value="<?= isset($_POST['nama_kota']) ? htmlspecialchars($_POST['nama_kota']) : '' ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" id="id_provinsi" name="id_provinsi" required>
                            <option value="">Pilih Provinsi</option>
                            <?php foreach($result_provinsi as $provinsi): ?>
                                <option value="<?= htmlspecialchars($provinsi['id_provinsi']) ?>"
                                    <?= (isset($_POST['id_provinsi']) && $_POST['id_provinsi'] == $provinsi['id_provinsi']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($provinsi['nama_provinsi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="../index.php?page=kota" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
>>>>>>> Stashed changes
</html>