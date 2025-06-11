<!-- navbar -->
<nav class="navbar navbar-yellow" style="background-color: #98FB98; padding: 10px 0; border-bottom: 2px solid #2E8B57; 
    position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">

        <!-- Logo & Pencarian -->
        <form action="pencarian.php" class="navbar-form navbar-left" style="display: flex; align-items: center; gap: 10px; margin: 0;">
            <a href="index.php">
                <img src="assets/images/first-aid-kit.png" height="50" style="margin-right: 10px;">
            </a>
            <input type="text" class="form-control" name="keyword" 
                   style="padding: 10px; border-radius: 5px; border: 1px solid #2E8B57; width: 250px;" 
                   placeholder="Cari produk atau kategori">
            <button class="btn btn-primary" style="background-color: #2E8B57; border: none; padding: 10px 15px; font-weight: bold;">CARI</button>
        </form>

        <!-- Menu Navigasi -->
        <ul class="nav navbar-nav navbar-right" style="display: flex; align-items: center; gap: 15px; list-style: none; padding: 0; margin: 0;">
            <li>
                <a href="keranjang.php" style="color: black; font-weight: bold; font-size: 18px; text-decoration: none; padding: 10px;">KERANJANG</a>
            </li>

            <?php if (isset($_SESSION["pelanggan"])): ?>
                <li>
                    <a href="riwayat.php" style="color: black; font-weight: bold; font-size: 18px; text-decoration: none; padding: 10px;">RIWAYAT BELANJA</a>
                </li>	
                <li>
                    <a href="logout.php" style="color: black; font-weight: bold; font-size: 18px; text-decoration: none; padding: 10px;">LOGOUT</a>
                </li>
            <?php else: ?>	
                <li>
                    <a href="login.php" style="color: black; font-weight: bold; font-size: 18px; text-decoration: none; padding: 10px;">LOGIN</a>
                </li>
                <li>
                    <a href="daftar.php" style="color: black; font-weight: bold; font-size: 18px; text-decoration: none; padding: 10px;">DAFTAR</a>
                </li>
            <?php endif ?>
        </ul>

    </div>
</nav>

<!-- Tambahkan margin-top agar konten tidak tertutup navbar -->
<style>
    body {
        padding-top: 80px; /* Sesuaikan dengan tinggi navbar */
    }
</style>
