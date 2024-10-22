<?php
include('../config.php');
include('../includes/header.php');
?>
<h2>Laporan customer</h2>
<form method="GET" action="">
 <div class="form-group mb-3">
 <label for="filter_stock">Filter Stok</label>
 <select name="filter_stock" class="form-control">
 <option value="">Semua Buku</option>
 <option value="out_of_stock" <?php if (isset($_GET['filter_stock']) && 
$_GET['filter_stock'] == 'in_stock') echo 'selected'; ?>></option>
 </select>
 </div>
 <button type="submit" class="btn btn-primary">Tampilkan</button>
<button type="button" class="btn btn-success" onclick="window.print();">
Cetak Laporan</button>
</form>
<table class="table table-bordered mt-3">
 <thead>
 <tr>
 <th>id_buku</th>
 <th>judul Buku</th>
 <th>penulis</th>
<th>tahun terbit</th> 
<th>stok</th>
 </tr>
 </thead>
<tbody>
<?php
 $where_clause = "";
 if (isset($_GET['filter_stock']) && $_GET['filter_stock'] != "") { 
$filter_stock = $_GET['filter_stock'];
 if ($filter_stock == "out_of_stock") {
 $where_clause = "WHERE stock = 0";
 } elseif ($filter_stock == "in_stock") {
 $where_clause = "WHERE stock > 0";
 }
 }
 $sql = "SELECT * FROM Buku $where_clause";
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
 </tr> 
 <?php
 endwhile;
 else:
 ?>
 <tr>
 <td colspan="5">Tidak ada Buku</td>
 </tr> 
 <?php 
endif;
 ?>
 </tbody>
</table>
<?php include('../includes/footer.php'); ?>