<?php 
session_start();
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
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
        .text-center {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>LOGIN PELANGGAN</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button class="btn btn-primary" name="login">LOGIN</button>
                        <div class="text-center">
                            <p>Belum punya akun? <a href="daftar.php" style="color: #2E8B57; font-weight: bold;">Daftar di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
if (isset($_POST['login'])) 
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Menggunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("SELECT * FROM pelanggan WHERE email_pelanggan=? AND password_pelanggan=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $hasil = $stmt->get_result();
    $akunyangcocok = $hasil->num_rows;

    if ($akunyangcocok == 1) 
    {
        $akun = $hasil->fetch_assoc();
        $_SESSION["pelanggan"] = $akun;
        echo "<script>alert('Anda Sukses Login');</script>";

        // Jika sudah belanja
        if (isset($_SESSION["keranjang"]) && !empty($_SESSION["keranjang"])) 
        {
            echo "<script>location='checkout.php';</script>";    
        }
        else 
        {
            echo "<script>location='riwayat.php';</script>";
        }
    }
    else 
    {
        echo "<script>alert('Login Gagal! Periksa kembali email dan password Anda.');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>

</body>
</html>
