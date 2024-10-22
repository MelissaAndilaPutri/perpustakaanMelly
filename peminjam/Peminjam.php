<?php
include('../config.php');
include('../includes/header.php');
// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// tambah data
?>
<h2>Daftar Peminjam</h2>
<a href="add_buku.php" class="btn btn-primary">Tambah Peminjam</a>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-light p-3">
        <h1 class="text-center">Daftar Peminjam</h1>
    </header>

    <main class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id_peminjam</th>
                    <th>id_buku</th>
                    <th>Nama anggota</th>
                    <th>Tanggal peminjam</th>
                    <th>Tahun pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                $conn = new mysqli('localhost', 'root', '', 'Perpustakaan');
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Ambil data customer
                $result = $conn->query("SELECT * FROM Peminjam");
                if (!$result) {
                    die("Query gagal: " . $conn->error);
                }

                // Tampilkan data
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    <td><?= $row['id_peminjam'] ?></td>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['nama anggota'] ?></td>
                        <td><?= $row['tanggal peminjam'] ?></td>
                        <td><?= $row['tanggal pengembalian'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                            <a href="edit_pem.php?id=<?= $row['id_buku'] ?>">Edit</a>
                            <a href="?hapus=<?= $row['id_peminjam'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <footer class="text-center p-3 bg-light">
        <p>&copy; 2024 Nama Perusahaan. Semua hak dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
