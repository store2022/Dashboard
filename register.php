<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $level = 'user';

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO admin (username, password, level) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $level])) {
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header('Location: index.php');
        exit;
    } else {
        $error = "Registration failed! Please try again.";
    }
}
?>

<!DOCTYPE html>
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
    <title>Register</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Register</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>