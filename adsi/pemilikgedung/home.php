<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Gedung</title>
    <link rel="stylesheet" href="../assets/css/cari.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <li><a href="permintaan.php">PERMINTAAN</a></li>
            </ul>
        </nav>
    </header>
    <section class="pilihan">
        <h2 id="pil">Input Informasi</h2>
        <h2>gedung</h2>
    </section>

    <section class="containercontent">
        <div class="grid">
        <?php
// Include file koneksi
include '../koneksi.php';

// Query untuk mengambil data dari tabel gedung
$sql = "SELECT * FROM gedung";
$result = $koneksi->query($sql);

// Iterasi hasil query dan tampilkan data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="gedung">';
        // Ubah tipe data blob menjadi base64 untuk ditampilkan sebagai gambar
        $imageData = base64_encode($row['image']);
        echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="' . htmlspecialchars($row['nama_gedung']) . '" class="gallery-image">';
        echo '<a href= "edit.php?id='. ($row['pemesanan_id']). '">' . htmlspecialchars($row['nama_gedung']).  '</a>';
        echo '</div>';
    }
} else {
    echo '<p>No data available</p>';
}

// Tutup koneksi
$koneksi->close();
?>

        </div>
    </section>

</body>
</html>