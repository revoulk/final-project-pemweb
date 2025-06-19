<?php
session_start();
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .panel {
            border-radius: 10px;
            border: 1px solid #2E8B57;
        }
        .panel-heading {
            background-color: #98FB98;
            color: black;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #2E8B57;
        }
        .btn-primary {
            background-color: #2E8B57;
            border: none;
            width: 100%;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #1d6b43;
        }
        .alert {
            margin-top: 10px;
        }
        .container-center {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>

<div class="container-center">
    <div class="text-center">
        <h2><strong>LOGIN ADMIN TOKO OBAT SURABAYA</strong></h2>
        <h5>(Login admin untuk mendapatkan akses)</h5>
    </div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>LOGIN ADMIN</h3>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="user">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <button class="btn btn-primary" name="login">LOGIN</button>
            </form>
            <br>
            <?php
            if (isset($_POST['login'])) {
                $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
                $yangcocok = $ambil->num_rows;

                if ($yangcocok == 1) {
                    $_SESSION['admin'] = $ambil->fetch_assoc();
                    echo "<div class='alert alert-success text-center'>✅ Login Sukses!</div>";
                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                } else {
                    echo "<div class='alert alert-danger text-center'>❌ Login Gagal! Periksa kembali username dan password Anda.</div>";
                    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
