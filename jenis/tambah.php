<?php
session_start();
<<<<<<< Updated upstream
include '../koneksi.php';

if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jenis = $_POST['id_jenis'];
    $nama_jenis = $_POST['nama_jenis'];

    $stmt = $pdo->prepare("INSERT INTO jenis (id_jenis, nama_jenis) VALUES (?, ?)");
    $stmt->execute([$id_jenis, $nama_jenis]);

    $_SESSION['success'] = "Jenis added successfully!";
    header('Location: index.php');
    exit;
=======
include_once(__DIR__ . '/../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jenis = trim($_POST['id_jenis']);
    $nama_jenis = trim($_POST['nama_jenis']);

    // Validasi input tidak boleh kosong
    if (empty($id_jenis) || empty($nama_jenis)) {
        $error = "ID Jenis dan Nama jenis tidak boleh kosong!";
    } 
    // Validasi ID harus diawali dengan J
    elseif (substr($id_jenis, 0, 1) !== 'J') {
        $error = "ID Jenis harus diawali dengan 'J'!";
    }
    // Validasi panjang ID maksimal 5 karakter
    elseif (strlen($id_jenis) > 5) {
        $error = "ID Jenis tidak boleh lebih dari 4 karakter!";
    }
    else {
        try {
            // Cek apakah ID jenis sudah ada
            $check_id = $pdo->prepare("SELECT COUNT(*) FROM jenis WHERE id_jenis = ?");
            $check_id->execute([$id_jenis]);
            $id_exists = $check_id->fetchColumn();

            // Cek apakah nama jenis sudah ada
            $check_nama = $pdo->prepare("SELECT COUNT(*) FROM jenis WHERE nama_jenis = ?");
            $check_nama->execute([$nama_jenis]);
            $nama_exists = $check_nama->fetchColumn();

            if ($id_exists) {
                $error = "ID Jenis sudah ada dalam database!";
            } 
            elseif ($nama_exists) {
                $error = "Nama jenis sudah ada dalam database!";
            }
            else {
                // Insert data baru
                $stmt = $pdo->prepare("INSERT INTO jenis (id_jenis, nama_jenis) VALUES (?, ?)");
                $stmt->execute([$id_jenis, $nama_jenis]);
                
                $_SESSION['success'] = "Data jenis berhasil ditambahkan!";
                header('Location: ../index.php?page=jenis');
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
<html lang="en">
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<<<<<<< Updated upstream
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
    <title>Add Jenis</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Add Jenis</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_jenis">Id Jenis</label>
                <input type="text" class="form-control" id="id_jenis" name="id_jenis" placeholder="id_jenis" value="J" required>
                <label for="nama_jenis">Nama Jenis</label>
                <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" placeholder="nama_jenis" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Jenis</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
=======
    <title>Tambah Jenis</title>
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
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Jenis</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="id_jenis">ID Jenis (Maksimal 5 karakter, diawali dengan J)</label>
                <input type="text" class="form-control" id="id_jenis" name="id_jenis" 
                       maxlength="5" 
                       value="<?php echo isset($_POST['id_jenis']) ? htmlspecialchars($_POST['id_jenis']) : 'J'; ?>" 
                       required>
            </div>
            <div class="form-group">
                <label for="nama_jenis">Nama Jenis</label>
                <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" 
                       value="<?php echo isset($_POST['nama_jenis']) ? htmlspecialchars($_POST['nama_jenis']) : ''; ?>" 
                       required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Jenis</button>
            <a href="../index.php?page=jenis" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Set default value saat halaman dimuat
        window.onload = function() {
            if (!document.getElementById('id_jenis').value) {
                document.getElementById('id_jenis').value = 'J';
            }
        };

        // Validasi input ID
        document.getElementById('id_jenis').addEventListener('input', function() {
            // Memastikan awalan selalu J
            if (!this.value.startsWith('J')) {
                this.value = 'J';
            }
            
            // Membatasi panjang maksimal 4 karakter
            if (this.value.length > 5) {
                this.value = this.value.slice(0, 5);
            }
        });
    </script>
</body>
</html>
>>>>>>> Stashed changes
