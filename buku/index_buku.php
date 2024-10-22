<?php
include('../config.php');
include('../includes/header.php');
?>
<h2>Daftar Buku</h2>
<a href="add_buku.php" class="btn btn-success mb-3">Tambah Data</a>
<table class="table table-bordered">
 <thead>
 <tr>
 <th>Id</th>
 <th>Judul Buku</th>
 <th>Penulis</th>
<th>Tahun Terbit</th> 
<th>Stok</th>
 </tr>
 </thead>
 <tbody>
 <?php
 $sql = "SELECT * FROM Buku ORDER BY name";
 $result = $conn->query($sql);
 if ($result->num_rows > 0):
 $no = 1; 
while ($row = $result->fetch_assoc()):
 ?>
 <tr>
 <td><?= $no++; ?></td>
 <td><?= $row['judul buku']; ?></td>
 <td><?= $row['penulis']; ?></td>
 <td><?= $row['tahun terbit']; ?></td>
 <td><?= $row['stok']; ?></td>
 <td>
 <a href="edit_buku.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
 <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" 
 onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
 </td>
 </tr>
<?php 
endwhile; 
else: 
?>
 <tr>
 <td colspan="5">Tidak ada data buku</td>
 </tr> 
<?php 
endif; 
?>
 </tbody>
</table>
<?php include('../includes/footer.php'); ?>