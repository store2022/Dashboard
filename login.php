<<<<<<< Updated upstream
=======
<?php
session_start();

// Koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "museum__3_";

$koneksi = mysqli_connect($host, $username, $password, $database);
if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Inisialisasi variable error
$error = '';

// Proses login
if(isset($_POST['login'])){
    try {
        // Validasi input kosong
        if(empty($_POST['username']) || empty($_POST['password'])) {
            throw new Exception("Username dan password harus diisi!");
        }

        // Bersihkan input
        $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
        $password = mysqli_real_escape_string($koneksi, trim($_POST['password']));

        // Query untuk mencari user
        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);

        if($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            // Verifikasi password (tanpa hash)
            if($password === $user['password']) {
                // Set session
                $_SESSION['user_id'] = $user['id_admin'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['level'] = $user['level'];
                $_SESSION['logged_in'] = true;

                // Redirect ke halaman index
                header("Location: index.php");
                exit();
            } else if ($user && password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id_admin'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['level'] = $user['level'];
                $_SESSION['logged_in'] = true;
                header('Location: index.php');
                exit;
            } else {
                throw new Exception("Password salah!");
            }
        } else {
            throw new Exception("Username tidak ditemukan!");
        }

    } catch(Exception $e) {
        $error = $e->getMessage();
    }
}
?>

>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
<<<<<<< Updated upstream
        /* Reset margin dan padding */
=======
>>>>>>> Stashed changes
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

<<<<<<< Updated upstream
        /* Latar belakang halaman */
=======
>>>>>>> Stashed changes
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4a90e2, #007aff);
        }

<<<<<<< Updated upstream
        /* Kotak form */
=======
>>>>>>> Stashed changes
        .login-form {
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

<<<<<<< Updated upstream
        /* Judul form */
=======
>>>>>>> Stashed changes
        .login-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

<<<<<<< Updated upstream
        /* Label dan input */
=======
>>>>>>> Stashed changes
        .login-form label {
            font-weight: bold;
            color: #555;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: all 0.3s;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #007aff;
            box-shadow: 0 0 5px rgba(0, 122, 255, 0.5);
        }

<<<<<<< Updated upstream
        /* Tombol login */
=======
>>>>>>> Stashed changes
        .login-form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: #fff;
            background-color: #007aff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form button:hover {
            background-color: #005bb5;
        }

<<<<<<< Updated upstream
        /* Pesan error */
=======
>>>>>>> Stashed changes
        .error-message {
            color: #ff4d4d;
            font-weight: bold;
            text-align: center;
<<<<<<< Updated upstream
            margin-top: 10px;
        }
=======
            margin-bottom: 10px;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #007aff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
>>>>>>> Stashed changes
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login Admin</h2>
<<<<<<< Updated upstream
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>

        <?php
        session_start(); // Start the session

        // Koneksi ke database
        $dsn = 'mysql:host=localhost;dbname=museum__3_';
        $username_db = 'root';
        $password_db = ''; // Sesuaikan dengan password database Anda jika ada
        try {
            $pdo = new PDO($dsn, $username_db, $password_db);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "<div class='error-message'>Koneksi gagal: " . $e->getMessage() . "</div>";
        }

        // Proses login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query untuk mencari pengguna
            $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $admin= $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($password, $admin['password'])) {
                // Password benar, set session dan redirect
                $_SESSION['username'] = $username; // Set session variable
                header('Location: index.php'); // Redirect to index page
                exit(); // Make sure to exit after redirection
            } else {
                // Password salah
                echo "<div class='error-message'>Username atau password salah.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
=======
        
        <?php if(!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <button type="submit" name="login">Login</button>

            <div class="register-link">
                Belum punya akun?
                <a href="register.php">Daftar</a>
            </div>
        </form>
    </div>
</body>
</html>
>>>>>>> Stashed changes
