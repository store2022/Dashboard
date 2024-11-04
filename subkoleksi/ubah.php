<?php
<<<<<<< Updated upstream
session_start();
include '../koneksi.php';

if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

$id_sub_koleksi = $_GET['id'] ?? null;

if (!$id_sub_koleksi) {
    header('Location: index.php');
    exit;
}

// Fetch current data for the sub koleksi
$stmt = $pdo->prepare("SELECT * FROM sub_koleksi WHERE id_sub_koleksi = ?");
$stmt->execute([$id_sub_koleksi]);
$subKoleksi = $stmt->fetch();

// Fetch all koleksi for dropdown
$koleksiList = $pdo->query("SELECT id_koleksi, nama_koleksi FROM koleksi")->fetchAll();
$zaman_list = $pdo->query("SELECT id_zaman, nama_zaman FROM zaman")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_koleksi = $_POST['id_koleksi'];
    $nama_sub_koleksi = $_POST['nama_sub_koleksi'];
    $deskripsi = $_POST['deskripsi'];
    $id_zaman = $_POST['id_zaman'];

    $stmt = $pdo->prepare("UPDATE sub_koleksi SET id_koleksi = ?, nama_sub_koleksi = ?, deskripsi = ?, id_zaman = ? WHERE id_sub_koleksi = ?");
    $stmt->execute([$id_koleksi, $nama_sub_koleksi, $deskripsi, $id_zaman, $id_sub_koleksi]);

    $_SESSION['success'] = "Sub Koleksi updated successfully!";
    header('Location: index.php');
    exit;
=======
require_once '../koneksi.php';

// Mengambil ID provinsi dari URL
if (isset($_GET['id'])) {
    $id_provinsi = $_GET['id'];

    // Mengambil data provinsi berdasarkan ID
    try {
        $stmt = $pdo->prepare("SELECT * FROM provinsi WHERE id_provinsi = ?");
        $stmt->execute([$id_provinsi]);
        $provinsi = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$provinsi) {
            echo "<script>
                alert('Provinsi tidak ditemukan!');
                window.location.href='../index.php?page=provinsi';
            </script>";
            exit();
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "<script>
        alert('ID Provinsi tidak ditentukan!');
        window.location.href='../index.php?page=provinsi';
    </script>";
    exit();
}

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Mengambil data dari form
        $nama_provinsi = $_POST['nama_provinsi'];
        $id_negara = $_POST['id_negara'];

        // Cek apakah nama provinsi sudah ada (kecuali untuk provinsi yang sama)
        $stmt_check_nama = $pdo->prepare("SELECT nama_provinsi FROM provinsi WHERE nama_provinsi = ? AND id_provinsi != ?");
        $stmt_check_nama->execute([$nama_provinsi, $id_provinsi]);
        
        if ($stmt_check_nama->rowCount() > 0) {
            echo "<script>
                alert('Nama Provinsi sudah ada!');
                window.location.href='edit.php?id=$id_provinsi';
            </script>";
            exit();
        }

        // Update data provinsi
        $query = "UPDATE provinsi SET nama_provinsi = ?, id_negara = ? WHERE id_provinsi = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nama_provinsi, $id_negara, $id_provinsi]);
        
        if ($stmt->rowCount() > 0) {
            echo "<script>
                alert('Data berhasil diperbarui!');
                window.location.href='../index.php?page=provinsi';
            </script>";
        } else {
            echo "<script>
                alert('Gagal memperbarui data!');
                window.location.href='edit.php?id=$id_provinsi';
            </script>";
        }
    } catch(PDOException $e) {
        echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.location.href='edit.php?id=$id_provinsi';
        </script>";
    }
    exit();
}

// Query untuk mengambil data negara
try {
    $query_negara = "SELECT * FROM negara";
    $stmt = $pdo->query($query_negara);
    $result_negara = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
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
    <title>Edit Sub Koleksi</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Sub Koleksi</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_koleksi">Koleksi</label>
                <select class="form-control" id="id_koleksi" name="id_koleksi" required>
                    <?php foreach ($koleksiList as $koleksi): ?>
                        <option value="<?= $koleksi['id_koleksi'] ?>" <?= $koleksi['id_koleksi'] == $subKoleksi['id_koleksi'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($koleksi['nama_koleksi']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_sub_koleksi">Nama Sub Koleksi</label>
                <input type="text" class="form-control" id="nama_sub_koleksi" name="nama_sub_koleksi" value="<?= htmlspecialchars($subKoleksi['nama_sub_koleksi']) ?>" required>
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= htmlspecialchars($subKoleksi['deskripsi']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="id_zaman">Zaman</label>
                <select class="form-control" id="id_zaman" name="id_zaman" required>
                    <?php foreach ($zaman_list as $zaman): ?>
                        <option value="<?= $zaman['id_zaman'] ?>" <?= $zaman['id_zaman'] == $subKoleksi['Id_Zaman'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($zaman['nama_zaman']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Sub Koleksi</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <?php
    if(isset($_POST['kirim'])){
        $aaaa = mysqli_query($koneksi, "UPDATE `subkoleksi`
                                        SET `id_koleksi` = '$_POST[id_koleksi]', `nama_subkoleksi` = '$_POST[nama_subkoleksi]', `deskripsi` = '$_POST[deskripsi]', `id_zaman` = '$_POST[id_zaman]'
                                        WHERE `id_subkoleksi` = '$_GET[id]'");
        header("Location: index.php?page=subkoleksi");
    }
    ?>
</body>

=======
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Provinsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Edit Provinsi</h2>
            </div>
            <div class="card-body">
                <form action="edit.php?id=<?php echo htmlspecialchars($id_provinsi); ?>" method="POST">
                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label">ID Provinsi</label>
                        <input type="text" class="form-control" id="id_provinsi" name="id_provinsi" value="<?php echo htmlspecialchars($provinsi['id_provinsi']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                        <input type="text" class="form-control" id="nama_provinsi" name=" nama_provinsi" value="<?php echo htmlspecialchars($provinsi['nama_provinsi']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_negara" class="form-label">Negara</label>
                        <select class="form-select" id="id_negara" name="id_negara" required>
                            <?php foreach ($result_negara as $negara) : ?>
                                <option value="<?php echo htmlspecialchars($negara['id_negara']); ?>" <?php if ($negara['id_negara'] == $provinsi['id_negara']) echo 'selected'; ?>><?php echo htmlspecialchars($negara['nama_negara']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</body>
>>>>>>> Stashed changes
</html>