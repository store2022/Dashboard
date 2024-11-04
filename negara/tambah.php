<?php
session_start();
<<<<<<< Updated upstream
include '../koneksi.php';

// Check if the user is authorized
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_negara = $_POST['id_negara'];
    $nama_negara = $_POST['nama_negara'];

    // Validasi input
    if (empty($id_negara) || empty($nama_negara)) {
        $_SESSION['error'] = "ID Negara dan Nama Negara harus diisi.";
    } else {
        // Insert negara ke dalam database
        $stmt = $pdo->prepare("INSERT INTO negara (id_negara, nama_negara) VALUES (?, ?)");
        
        if ($stmt->execute([$id_negara, $nama_negara])) {
            $_SESSION['success'] = "Negara telah ditambahkan!";
            header('Location: index.php'); // Redirect ke halaman index
            exit;
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat menambahkan negara.";
=======
include_once(__DIR__ . '/../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_negara = trim($_POST['id_negara']);
    $nama_negara = trim($_POST['nama_negara']);

    // Validasi input tidak boleh kosong
    if (empty($id_negara) || empty($nama_negara)) {
        $error = "ID Negara dan Nama negara tidak boleh kosong!";
    } 
    // Validasi ID harus diawali dengan N3
    elseif (substr($id_negara, 0, 2) !== 'N3') {
        $error = "ID Negara harus diawali dengan 'N3'!";
    }
    // Validasi panjang ID maksimal 4 karakter
    elseif (strlen($id_negara) > 4) {
        $error = "ID Negara tidak boleh lebih dari 4 karakter!";
    }
    else {
        try {
            // Cek apakah ID negara sudah ada
            $check_id = $pdo->prepare("SELECT COUNT(*) FROM negara WHERE id_negara = ?");
            $check_id->execute([$id_negara]);
            $id_exists = $check_id->fetchColumn();

            // Cek apakah nama negara sudah ada
            $check_nama = $pdo->prepare("SELECT COUNT(*) FROM negara WHERE nama_negara = ?");
            $check_nama->execute([$nama_negara]);
            $nama_exists = $check_nama->fetchColumn();

            if ($id_exists) {
                $error = "ID Negara sudah ada dalam database!";
            } 
            elseif ($nama_exists) {
                $error = "Nama negara sudah ada dalam database!";
            }
            else {
                // Insert data baru
                $stmt = $pdo->prepare("INSERT INTO negara (id_negara, nama_negara) VALUES (?, ?)");
                $stmt->execute([$id_negara, $nama_negara]);
                
                $_SESSION['success'] = "Data negara berhasil ditambahkan!";
                header('Location: ../index.php?page=negara');
                exit;
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
>>>>>>> Stashed changes
        }
    }
}
?>

<!DOCTYPE html>
<<<<<<< Updated upstream
<html lang="id">
=======
<html lang="en">
>>>>>>> Stashed changes
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tambah Negara</title>
<<<<<<< Updated upstream
=======
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .btn {
            margin-right: 5px;
        }
        .alert {
            margin-top: 15px;
        }
    </style>
>>>>>>> Stashed changes
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Negara</h1>
        
<<<<<<< Updated upstream
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>ID Negara</label>
                <input type="text" name="id_negara" class="form-control" value="<?= htmlspecialchars($id_negara ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Nama Negara</label>
                <input type="text" name="nama_negara" class="form-control" value="<?= htmlspecialchars($nama_negara ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
=======
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="id_negara">ID Negara (Maksimal 4 karakter, diawali dengan N3)</label>
                <input type="text" class="form-control" id="id_negara" name="id_negara" 
                       maxlength="4" 
                       value="<?php echo isset($_POST['id_negara']) ? htmlspecialchars($_POST['id_negara']) : 'N3'; ?>" 
                       required>
            </div>
            <div class="form-group">
                <label for="nama_negara">Nama Negara</label>
                <input type="text" class="form-control" id="nama_negara" name="nama_negara" 
                       value="<?php echo isset($_POST['nama_negara']) ? htmlspecialchars($_POST['nama_negara']) : ''; ?>" 
                       required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Negara</button>
            <a href="../index.php?page=negara" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Set default value saat halaman dimuat
        window.onload = function() {
            if (!document.getElementById('id_negara').value) {
                document.getElementById('id_negara').value = 'N3';
            }
        };

        // Validasi input ID
        document.getElementById('id_negara').addEventListener('input', function() {
            // Memastikan awalan selalu N3
            if (!this.value.startsWith('N3')) {
                this.value = 'N3';
            }
            
            // Membatasi panjang maksimal 4 karakter
            if (this.value.length > 4) {
                this.value = this.value.slice(0, 4);
            }
        });
    </script>
>>>>>>> Stashed changes
</body>
</html>