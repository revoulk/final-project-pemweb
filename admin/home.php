<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <!-- BOOTSTRAP STYLES -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLES -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES -->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            font-weight: bold;
            color: #2E8B57;
        }
        hr {
            border: 2px solid #2E8B57;
            width: 50%;
            margin: 20px auto;
        }
        h4 {
            text-align: center;
            font-weight: bold;
            color: #2E8B57;
        }
        .table-container {
            display: flex;
            justify-content: center;
        }
        .table {
            width: 80%;
            background: white;
            border-radius: 5px;
        }
        .table thead {
            background-color: #2E8B57;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .table tbody tr {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Selamat Datang Administrator</h2>
        <hr>
        <h4>Data Administrator :</h4>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Administrator</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $ambil = $koneksi->query("SELECT * FROM admin");
                    while ($pecah = $ambil->fetch_assoc()) { 
                    ?>
                    <tr>
                        <td><?php echo $pecah['id_admin']; ?></td>
                        <td><?php echo $pecah['nama_lengkap']; ?></td>
                        <td><?php echo $pecah['username']; ?></td>
                        <td><?php echo $pecah['password']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>
