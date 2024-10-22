<?php
include('../config.php');
include('../includes/header.php');
?>
<h2>Laporan Peminjam</h2>
<form method="GET" action="">
 <div class="form-group mb-3">
 <label for="filter_stock">Filter Stok</label>
 <select name="filter_stock" class="form-control">
 <option value="">Semua Produk</option>
 <option value="out_of_stock" <?php if (isset($_GET['filter_stock']) && 
$_GET['filter_stock'] == 'out_of_stock') echo 'selected'; ?>>Stok Habis</option>
 <option value="in_stock" <?php if (isset($_GET['filter_stock']) && 
$_GET['filter_stock'] == 'in_stock') echo 'selected'; ?>>Stok Tersedia</option>
 </select>
 </div>
 <button type="submit" class="btn btn-primary">Tampilkan</button>
<button type="button" class="btn btn-success" onclick="window.print();">
Cetak Laporan</button>
</form>
<table class="table table-bordered mt-3">
 <thead>
 <tr>
 <th>No</th>
 <th>Nama Produk</th>
 <th>Deskripsi</th>
<th>Harga</th> 
<th>Stok</th>
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
 $sql = "SELECT * FROM products $where_clause";
 $result = $conn->query($sql);
 if ($result->num_rows > 0):
 $no = 1; 
while ($row = $result->fetch_assoc()):
?>
 <tr>
 <td><?= $no++; ?></td>
 <td><?= $row['name']; ?></td>
 <td><?= $row['description']; ?></td>
 <td>Rp. <?= number_format($row['price']); ?></td>
 <td><?= $row['stock']; ?></td>
 </tr> 
 <?php
 endwhile;
 else:
 ?>
 <tr>
 <td colspan="5">Tidak ada produk</td>
 </tr> 
 <?php 
endif;
 ?>
 </tbody>
</table>
<?php include('../includes/footer.php'); ?>