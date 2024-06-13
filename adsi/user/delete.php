<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['pemesanan_id']) || !isset($_GET['tanggal_pemesanan']) || !isset($_GET['jumlah_pembayaran']) || !isset($_GET['status'])) {
    echo "Parameter tidak lengkap.";
    exit();
}

$pemesanan_id = $_GET['pemesanan_id'];
$tanggal_pemesanan = $_GET['tanggal_pemesanan'];
$jumlah_pembayaran = $_GET['jumlah_pembayaran'];
$status = $_GET['status'];

// Mengonversi format tanggal ke yang sesuai dengan database
$tanggal_pemesanan_db_format = DateTime::createFromFormat('d M', $tanggal_pemesanan)->format('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm'])) {
        if ($_POST['confirm'] == 'yes') {
            // Lakukan penghapusan data
            $stmt = $koneksi->prepare("DELETE FROM pemesanan WHERE pemesanan_id = ? AND user_id = ? AND tanggal_pemesanan = ? AND jumlah_pembayaran = ? AND status = ?");
            $stmt->bind_param("iisds", $pemesanan_id, $user_id, $tanggal_pemesanan_db_format, $jumlah_pembayaran, $status);

            if ($stmt->execute()) {
                echo "Pemesanan berhasil dihapus.";
                header("Location: pesanan.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } elseif ($_POST['confirm'] == 'no') {
            // Redirect kembali ke pesanan.php jika pengguna memilih "Tidak"
            header("Location: pesanan.php");
            exit();
        }
    } else {
        // Jika tidak ada konfirmasi yang dikirimkan
        header("Location: pesanan.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Pemesanan</title>
    <link rel="stylesheet" href="../assets/css/pesanan.css">
</head>
<body>
<header class="sticky-header">
    <div class="logo">
        <img src="../assets/image/logo-removebg-preview.png" alt="Logo" class="logo-image">
    </div>
    <nav>
        <ul>
            <li><a href="homepage.php">MAIN</a></li>
            <li><a href="cari.php">CARI</a></li>
            <li><a href="contact.php">CONTACTS</a></li>
            <li><a href="pesanan.php" class="active">PEMESANAN</a></li>
        </ul>
    </nav>
</header>

<section class="confirmation">
    <h2>Konfirmasi Penghapusan</h2>
    <p>Apakah Anda yakin ingin menghapus pemesanan ini?</p>
    <p>Detail Pemesanan:</p>
    <ul>
        <li>ID Pemesanan: <?php echo htmlspecialchars($pemesanan_id); ?></li>
        <li>Tanggal Pemesanan: <?php echo htmlspecialchars($tanggal_pemesanan); ?></li>
        <li>Jumlah Pembayaran: Rp. <?php echo number_format($jumlah_pembayaran, 0, ',', '.'); ?>,-</li>
        <li>Status: <?php echo htmlspecialchars($status); ?></li>
    </ul>
    <form method="POST" action="">
        <button type="submit" name="confirm" value="yes">Ya</button>
        <button type="submit" name="confirm" value="no">Tidak</button>
    </form>
</section>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-column">
            <img src="../assets/image/logo.jpg" alt="Logo" class="footer-logo">
        </div>
        <div class="footer-column">
            <h3>Information</h3>
            <ul>
                <li><a href="#">Main</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Contacts</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Contacts</h3>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i> Bandar Lampung</li>
                <li><i class="fas fa-phone-alt"></i> +62812345678</li>
                <li><i class="fas fa-envelope"></i> goged@gmail.com</li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Social Media</h3>
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2021 All Rights Reserved</p>
    </div>
</footer>
</body>
</html>
