<?php
include 'db.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
   // products.php - bagian GET
case 'GET':
    // Cek apakah ada parameter 'id' di URL
    if (isset($_GET['id'])) {
        // Ambil produk berdasarkan ID yang diberikan
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        $produk = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika produk ditemukan, tampilkan data produk
        if ($produk) {
            echo json_encode($produk);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Produk tidak ditemukan']);
        }
    } else {
        // Jika ID tidak diberikan, ambil semua produk
        $stmt = $pdo->query("SELECT * FROM produk");
        $produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($produk);
    }
    break;


    case 'POST':
        // Tambah produk baru
        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['nama_produk']) && !empty($data['kategori']) && !empty($data['harga']) && !empty($data['gambar'])) {
            $stmt = $pdo->prepare("INSERT INTO produk (nama_produk, kategori, harga, gambar) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['nama_produk'], $data['kategori'], $data['harga'], $data['gambar']]);
            echo json_encode(['message' => 'Produk berhasil ditambahkan']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Data tidak valid']);
        }
        break;

    case 'PUT':
        // Perbarui produk
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_GET['id'] ?? null;

        if ($id && !empty($data['nama_produk']) && !empty($data['kategori']) && !empty($data['harga']) && !empty($data['gambar'])) {
            $stmt = $pdo->prepare("UPDATE produk SET nama_produk = ?, kategori = ?, harga = ?, gambar = ? WHERE id = ?");
            $stmt->execute([$data['nama_produk'], $data['kategori'], $data['harga'], $data['gambar'], $id]);
            echo json_encode(['message' => 'Produk berhasil diperbarui']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Data tidak valid atau ID tidak ditemukan']);
        }
        break;

    case 'DELETE':
        // Hapus produk
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['message' => 'Produk berhasil dihapus']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'ID tidak ditemukan']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Metode tidak didukung']);
        break;
}
?>
