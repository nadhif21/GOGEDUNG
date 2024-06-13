<<<<<<< HEAD
<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['pemesanan_id']) || !isset($_GET['user_id']) || !isset($_GET['tanggal']) || !isset($_GET['jumlah']) || !isset($_GET['status'])) {
    echo "Parameter tidak lengkap.";
    exit();
}

$pemesanan_id = $_GET['pemesanan_id'];
$user_id = $_GET['user_id'];
$tanggal = $_GET['tanggal'];
$jumlah = $_GET['jumlah'];
$status = $_GET['status'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        if ($_POST['cancel'] == 'yes') {
        $stmt = $koneksi->prepare("UPDATE pemesanan SET status = 'gagal' WHERE pemesanan_id = ? AND user_id = ? AND tanggal_pemesanan = ? AND jumlah_pembayaran = ? AND status = ?");
        $stmt->bind_param("iisss", $pemesanan_id, $user_id, $tanggal, $jumlah, $status);

        if ($stmt->execute()) {
            echo "Pemesanan berhasil diupdate.";
            header("Location: pembayaran.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif ($_POST['cancel'] == 'no') {
        header("Location: pembayaran.php");
        exit();
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalkan Pemesanan</title>
    <link rel="stylesheet" href="../assets/css/pesanan.css">
</head>
<body>
    <section class="cancelation">
        <h2>Kancelasi Pembatalan</h2>
        <p>Apakah Anda yakin ingin membatalkan pemesanan ini?</p>
        <form method="POST" action="">
            <button type="submit" name="cancel" value="yes">Ya</button>
            <button type="submit" name="cancel" value="no">Tidak</button>
        </form>
    </section>
</body>
</html>
=======
<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['pemesanan_id']) || !isset($_GET['user_id']) || !isset($_GET['tanggal']) || !isset($_GET['jumlah']) || !isset($_GET['status'])) {
    echo "Parameter tidak lengkap.";
    exit();
}

$pemesanan_id = $_GET['pemesanan_id'];
$user_id = $_GET['user_id'];
$tanggal = $_GET['tanggal'];
$jumlah = $_GET['jumlah'];
$status = $_GET['status'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        $stmt = $koneksi->prepare("UPDATE pemesanan SET status = 'gagal' WHERE pemesanan_id = ? AND user_id = ? AND tanggal_pemesanan = ? AND jumlah_pembayaran = ? AND status = ?");
        $stmt->bind_param("iisss", $pemesanan_id, $user_id, $tanggal, $jumlah, $status);

        if ($stmt->execute()) {
            echo "Pemesanan berhasil diupdate.";
            header("Location: pembayaran.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        header("Location: pembayaran.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalkan Pemesanan</title>
    <link rel="stylesheet" href="../assets/css/pesanan.css">
</head>
<body>
    <section class="confirmation">
        <h2>Konfirmasi Pembatalan</h2>
        <p>Apakah Anda yakin ingin membatalkan pemesanan ini?</p>
        <form method="POST" action="">
            <button type="submit" name="cancel" value="yes">Ya</button>
            <button type="submit" name="cancel" value="no">Tidak</button>
        </form>
    </section>
</body>
</html>
>>>>>>> f0945baba89b352414e96942c4e433ab0d97bce4
