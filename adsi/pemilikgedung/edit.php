<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Informasi Gedung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form input,
        .container form textarea {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .container form input:focus,
        .container form textarea:focus {
            border-color: #aaa;
            outline: none;
        }
        .container form button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #666;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .container form button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Informasi Gedung</h1>
        <?php
        include '../koneksi.php';

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Ensure ID is set and valid
        if ($id <= 0) {
            echo "Invalid ID.";
            exit;
        }

        // Fetch the existing data for the given ID
        $sql = "SELECT * FROM gedung WHERE pemesanan_id = $id";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nama_gedung = $row['nama_gedung'];
            $harga = $row['harga'];
            $detail = $row['detail'];
        } else {
            echo "No data found for the given ID.";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_gedung = $_POST['nama_gedung'];
            $harga = $_POST['harga'];
            $detail = $_POST['detail'];

            // Handle file upload
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $sql = "UPDATE gedung SET nama_gedung='$nama_gedung', harga='$harga', detail='$detail', image='$image' WHERE pemesanan_id=$id";
            } else {
                $sql = "UPDATE gedung SET nama_gedung='$nama_gedung', harga='$harga', detail='$detail' WHERE pemesanan_id=$id";
            }

            if ($koneksi->query($sql) === TRUE) {
                echo "<p>Informasi gedung berhasil diperbarui.</p>";
                header("location:home.php");
            } else {
                echo "Error updating record: " . $koneksi->error;
            }
        }

        $koneksi->close();
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $id); ?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="nama_gedung" placeholder="Nama Gedung" value="<?php echo htmlspecialchars($nama_gedung); ?>" required>
            <input type="number" name="harga" placeholder="Harga" value="<?php echo htmlspecialchars($harga); ?>" required>
            <input type="file" name="image" accept="image/*">
            <textarea name="detail" placeholder="Detail" required><?php echo htmlspecialchars($detail); ?></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
