<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['pemesanan_id']) || !isset($_GET['user_id']) || !isset($_GET['tanggal_pemesanan']) || !isset($_GET['jumlah_pembayaran']) || !isset($_GET['status'])) {
    echo "Parameter tidak lengkap.";
    exit();
}

$pemesanan_id = $_GET['pemesanan_id'];
$user_id = $_GET['user_id'];
$tanggal_pemesanan = $_GET['tanggal_pemesanan'];
$jumlah_pembayaran = $_GET['jumlah_pembayaran'];
$status = $_GET['status'];

$sql = "SELECT pemesanan.pemesanan_id, pemesanan.user_id, DATE_FORMAT(pemesanan.tanggal_pemesanan, '%d %M') as formatted_date, pemesanan.jumlah_pembayaran, pemesanan.status, unit.name as user_name 
        FROM pemesanan 
        JOIN unit ON pemesanan.user_id = unit.user_id
        WHERE pemesanan.pemesanan_id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $pemesanan_id);
$stmt->execute();
$result = $stmt->get_result();
$pemesanan = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        $tanggal_pemesanan_db_format = date('Y-m-d', strtotime($tanggal_pemesanan));
        $stmt = $koneksi->prepare("UPDATE pemesanan SET status = 'gagal' WHERE pemesanan_id = ? AND user_id = ? AND tanggal_pemesanan = ? AND jumlah_pembayaran = ? AND status = ?");
        $stmt->bind_param("iisds", $pemesanan_id, $user_id, $tanggal_pemesanan_db_format, $jumlah_pembayaran, $status);

        if ($stmt->execute()) {
            echo "Pemesanan berhasil diperbarui menjadi gagal.";
            header("Location: pesanan.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
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
    <title>Konfirmasi Pembatalan</title>
    <link rel="stylesheet" href="../assets/css/pesanan.css">
</head>
<body>
<section class="confirmation">
    <h2>Konfirmasi Pembatalan</h2>
    <?php if ($pemesanan): ?>
        <p>Apakah Anda yakin ingin mengubah status pemesanan ini menjadi gagal?</p>
        <p>Nama: <?php echo htmlspecialchars($pemesanan['user_name']); ?></p>
        <p>Tanggal: <?php echo htmlspecialchars($pemesanan['formatted_date']); ?></p>
        <p>Jumlah Pembayaran: Rp. <?php echo number_format($pemesanan['jumlah_pembayaran'], 0, ',', '.'); ?>,-</p>
        <p>Status: <?php echo htmlspecialchars($pemesanan['status']); ?></p>
        <form method="POST" action="">
            <button type="submit" name="confirm" value="yes">Ya</button>
            <button type="submit" name="confirm" value="no">Tidak</button>
        </form>
    <?php else: ?>
        <p>Pemesanan tidak ditemukan.</p>
    <?php endif; ?>
</section>
</body>
</html>
