<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Sneakers Heaven</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .nav-link {
            text-align: center;
            margin-top: 20px;
        }
        .nav-link a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .nav-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Produk</h1>
        <form action="tambah_produk.php" method="POST">
            <input type="text" name="nama_produk" placeholder="Nama Produk" required>
            <input type="text" name="kategori" placeholder="Kategori" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="text" name="gambar" placeholder="URL Gambar" required>
            <button type="submit">Tambah Produk</button>
        </form>
        <div class="nav-link">
            <a href="index.php">Kembali ke Halaman Utama</a>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'db.php';

        $nama_produk = $_POST['nama_produk'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $gambar = $_POST['gambar'];

        if (!empty($nama_produk) && !empty($kategori) && !empty($harga) && !empty($gambar)) {
            $stmt = $pdo->prepare("INSERT INTO produk (nama_produk, kategori, harga, gambar) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nama_produk, $kategori, $harga, $gambar]);

            echo "<script>alert('Produk berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Harap isi semua data!');</script>";
        }
    }

    
    ?>
</body>
</html>
