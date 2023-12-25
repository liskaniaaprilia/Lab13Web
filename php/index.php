
<?php
include("koneksi.php");

// query untuk menampilkan data
$q = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = "WHERE nama LIKE '{$q}%'"; 
}
$title = 'Data Barang';
$sql = 'SELECT * FROM data_barang ';
$sql_count = "SELECT COUNT(*) FROM data_barang";
if (isset($sql_where)) {
    $sql .= $sql_where;
    $sql_count .= $sql_where;
}
$result_count = mysqli_query($conn, $sql_count);
$count = 0;
if ($result_count) {
    $r_data = mysqli_fetch_row($result_count);
    $count = $r_data[0];
}
$per_page = 1;
$num_page = ceil ($count / $per_page);
$limit = $per_page;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $per_page;
} else {
    $offset = 0;
    $page = 1;
}
$sql .= "LIMIT {$offset},{$limit}";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style-index.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Data Barang</title>
</head>
    <div class="container shadow-lg" style="font-family: 'Times New Roman', Times, serif; color: black; text-align: center;"> 
    <div class="card-body bg-light p-3">
        <h1 class="text-secondary py-3 text-opacity-50 fw-bold" style="font-family: 'Times New Roman', Times, serif; color: black; text-align: center;">Data Barang</h1>
    </div>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8FBC8F;">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active ms-4">
                <a class="nav-link text-light fs-5 fw-semibold" aria-current="page" href="Home.html">Home</a>
            </li>
            <li class="nav-item ms-4">
                <a class="nav-link fs-5 fw-semibold" href="sign-in.php">Login</a>
            </li>
            </ul>
            
        </div>
    </div> 
</nav> <br>
            <a href="tambah.php" class="tombol2" style="background-color: #8fbc8f; font-family: 'Times New Roman', Times, serif; color: white; border-radius: 5px; padding: 10px 20px;">Tambah Barang</a> <br><br>
            <form>
                <div class="form-group" action="" method="get" >
                    <label for="q">Cari Barang</label>
                    <input type="text" placeholder="Masukkan Pencarian"  id="q" name="q" class="input-q" value="<?php echo $q ?>">
                    <button type="submit" name="submit" class="btn btn-primary" style="background-color: #8fbc8f;">Cari</button>
                </div>
            </form>
            <table class="table table-striped table-hover">
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Katagori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php if($result): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><img src="gambar/<?= $row['gambar'];?>" alt="<?=$row['nama'];?>"></td>
                <td><?= $row['nama'];?></td>
                <td><?= $row['kategori'];?></td>
                <td><?= $row['harga_jual'];?></td>
                <td><?= $row['harga_beli'];?></td>
                <td><?= $row['stok'];?></td>
                <td>
                    <a class="tombol3" href="ubah.php?id=<?= $row['id_barang'];?>">Ubah</a>
                    <a class="tombol3" href="hapus.php?id=<?= $row['id_barang'];?>">Hapus</a> 
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="7">Belum ada data</td>
            </tr>
            <?php endif; ?>
            </table>
            <nav aria-label="Page navigation example" >
            <ul class = "pagination">
                <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <?php for ($i=1; $i <= $num_page; $i++) {
                    $link = "?page={$i}";
                    if (!empty($q)) $link .= "&q={$q}";
                    $class = ($page == $i ? 'active' : '');
                    echo "<li><a class=\"{$class}\" href=\"{$link}\">{$i}</a></li>";
                } ?>
                <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
            </nav>

            <div class="card-footer text-start text-light p-2" style="background-color: #8FBC8F;">
                <p>&copy; 2023 - Data Barang</p>
            </div>
        </div>
    </div>
    
</body>
</html>