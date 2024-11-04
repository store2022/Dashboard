<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username); // 's' menunjukkan tipe data string
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah pengguna ada
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Memeriksa password
        if (password_verify($password, $row['password'])) {
            // Jika login berhasil, set session dan redirect
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Halaman dashboard setelah login
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }

    $stmt->close(); // Menutup prepared statement
}

$koneksi->close(); // Menutup koneksi
?>
