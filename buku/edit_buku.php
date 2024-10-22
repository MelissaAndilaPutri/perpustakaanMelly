<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'Perpustakaan'); // Gantilah 'db_crud' dengan nama database Anda

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID customer dari URL
$id = $_GET['id'];

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_buku = $_POST['judul buku'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    // Query untuk mengupdate data customer
    $sql = "UPDATE Buku SET judul buku='$judul_buku', penulis='$penulis', tahun_terbit='$tahun_terbit', stok='$stok' WHERE id_buku=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Buku berhasil diperbarui!";
        header("Location: Buku.php"); // Redirect ke halaman Buku setelah update
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data customer untuk ditampilkan di form
$result = $conn->query("SELECT * FROM Buku WHERE id_buku = $id");

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . $conn->error);
}

$row = $result->fetch_assoc();

if (!$row) {
    die("Data Buku tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Customer</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $row['id_buku'] ?>">
        <input type="text" name="judul_buku" value="<?= $row['judul_buku'] ?>" required>
        <input type="text" name="penulis" value="<?= $row['penulis'] ?>" required>
        <input type="date" name="tahun_terbit" value="<?= $row['tahun_terbit'] ?>">
        <textarea name="stok" required><?= $row['stok'] ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="customer.php">Kembali ke Daftar Buku</a>
</body>
</html>

<?php $conn->close(); ?>
