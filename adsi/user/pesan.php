<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_SESSION['pemesanan_id'])) {
    echo "Pemesanan ID is not set.";
    exit();
}

$pemesanan_id = $_SESSION['pemesanan_id'];
$user_id = $_SESSION['user_id'];

$stmt = $koneksi->prepare("SELECT nama_gedung, harga, image FROM gedung WHERE pemesanan_id = ?");
$stmt->bind_param("i", $pemesanan_id);
$stmt->execute();
$stmt->bind_result($nama_gedung, $harga, $image);
$stmt->fetch();
$stmt->close();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
    $nama_kartu = $_POST['nama_kartu'];
    $nomor_kartu = $_POST['nomor_kartu'];
    $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];
    $jumlah_pembayaran = $harga;
    $status = "proses";

    $stmt_check = $koneksi->prepare("SELECT COUNT(*) FROM pemesanan WHERE pemesanan_id = ? AND tanggal_pemesanan = ?");
    $stmt_check->bind_param("is", $pemesanan_id, $tanggal_pemesanan);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        $error_message = "Tanggal pemesanan sudah ada untuk pemesanan ID ini.";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO pemesanan (pemesanan_id, user_id, tanggal_pemesanan, nama_kartu, nomor_kartu, tanggal_kadaluarsa, jumlah_pembayaran, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssds", $pemesanan_id, $user_id, $tanggal_pemesanan, $nama_kartu, $nomor_kartu, $tanggal_kadaluarsa, $jumlah_pembayaran, $status);

        if ($stmt->execute()) {
            header("Location: afterpayment.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $koneksi->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="../assets/css/pesan.css">
</head>
<body>
<header class="sticky-header">
    <div class="logo">
        <img src="../assets/image/logo-removebg-preview.png" alt="Logo" class="logo-image">
    </div>
    <nav>
        <ul>
            <li><a href="homepage.php">MAIN</a></li>
            <li><a href="cari.php" class="active">CARI</a></li>
            <li><a href="contact.php">CONTACTS</a></li>
            <li><a href="pesanan.php">PEMESANAN</a></li>
        </ul>
    </nav>
</header>
<section class="pilihan">
    <h2>Payment</h2>
</section>
<img src="../assets/image/backpay.png" class="back">
<div class="container">
    <div class="payment-form">
        <?php if ($error_message): ?>
            <script>
                alert('<?php echo $error_message; ?>');
            </script>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" required>
            </div>
            <h2>Payment Details</h2>
            <div class="form-group">
                <input type="text" name="nama_kartu" placeholder="Enter Name on Card" required>
            </div>
            <div class="form-group">
                <input type="text" name="nomor_kartu" placeholder="Card Number" required>
            </div>
            <div class="form-group">
                <input type="date" name="tanggal_kadaluarsa" placeholder="Expire Date" required>
            </div>
            <div class="buttons">
                <a href="detaildance.php" class="back-button">Back</a>
                <button type="submit" class="confirm-button">Confirm payment Rp <?php echo number_format($harga, 0, ',', '.'); ?>,-</button>
            </div>
        </form>
    </div>
    <div class="image-section">
        <div class="image-text">
            <?php echo $nama_gedung; ?><br>Rp <?php echo number_format($harga, 0, ',', '.'); ?>,-
        </div>
        <div class="image-container">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'" alt="Gedung Image" style="width: 400px; height: 300px">'; ?>
        </div>
    </div>
</div>
</body>
</html>
