<?php
include('../config.php');
include('../includes/header.php');
?>
<h2>Daftar Peminjam</h2>
<a href="add.php" class="btn btn-success mb-3">Tambah Data</a>
<table class="table table-bordered">
 <thead>
 <tr>
 <th>id_peminjam</th>
 <th>id_buku</th>
 <th>Nama anggota</th>
 <th>tanggal peminjam</th>
<th>tanggal pengembalian</th>
<th>status</th>
<th>Aksi</th>
 </tr>
 </thead>
 <tbody>
 <?php
 $sql = "SELECT * FROM peminjam ORDER BY name";
 $result = $conn->query($sql);
 if ($result->num_rows > 0):
 $no = 1; 
while ($row = $result->fetch_assoc()):
 ?>
 <tr>
 <td><?= $no++; ?></td>
 <td><?= $row['id_peminjam']; ?></td>
 <td><?= $row['id_buku']; ?></td>
 <td><?= $row['nama anggota']; ?></td>
 <td><?= $row['tanggal peminjam']; ?></td>
 <td><?= $row['tanggal pengembalian']; ?></td>
 <td><?= $row['status']; ?></td>
 <td>Rp. <?= number_format($row['price']); ?></td>
 <td>
 <a href="edit_pem.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
 <a href="delete_pem.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" 
 onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
 </td>
 </tr>
<?php 
endwhile; 
else: 
?>
 <tr>
 <td colspan="5">Tidak ada data Peminjam</td>
 </tr> 
<?php 
endif; 
?>
 </tbody>
</table>
<?php include('../includes/footer.php'); ?>