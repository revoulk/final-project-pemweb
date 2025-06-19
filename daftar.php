<?php require_once 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>DAFTAR PELANGGAN</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
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
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                    <h3>DAFTAR PELANGGAN</h3>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="alamat" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Telepon/HP</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="telepon" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Ulangi Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="confirm_password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" name="daftar">DAFTAR</button>
                            </div>
                        </div>
                    </form>

                    <?php 
                    // Jika tombol daftar ditekan 
                    if (isset($_POST["daftar"])) 
                    {
                        $nama = $_POST["nama"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $confirm_password = $_POST["confirm_password"];
                        $alamat = $_POST["alamat"];
                        $telepon = $_POST["telepon"];

                        // Cek apakah password dan konfirmasi password cocok
                        if ($password !== $confirm_password) {
                            echo "<script>alert('Pendaftaran Gagal, Password Tidak Cocok');</script>";
                            echo "<script>location='daftar.php';</script>";
                            exit;
                        }

                        // Cek apakah email sudah digunakan 
                        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                        $yangcocok = $ambil->num_rows;

                        if ($yangcocok == 1) {
                            echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan');</script>";
                            echo "<script>location='daftar.php';</script>";
                        } else {
                            // Insert ke database
                            $koneksi->query("INSERT INTO pelanggan(email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) 
                                            VALUES('$email', '$password', '$nama', '$telepon', '$alamat')");

                            echo "<script>alert('Pendaftaran Sukses, Silahkan Login');</script>";
                            echo "<script>location='login.php';</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
