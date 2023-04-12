<?php
$id_produk = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori 
    WHERE id_produk = '$id_produk'");
$detailproduk = $ambil->fetch_assoc();

// Menampilkan semua foto_produk
$fotoproduk = array();
$ambil_foto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk = '$id_produk'");
while ($tiap = $ambil_foto->fetch_assoc()) {
    $fotoproduk[] = $tiap;
}

?>

<div class="card">
    <h5 class="card-header">Data Produk</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <tr>
                <th>Kategori</th>
                <td><?php echo $detailproduk['nama_kategori']; ?></td>
            </tr>
            <tr>
                <th>Produk</th>
                <td><?php echo $detailproduk['nama_produk']; ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp<?php echo number_format($detailproduk['harga_produk']); ?></td>
            </tr>
            <tr>
                <th>Berat (gr)</th>
                <td><?php echo $detailproduk['berat_produk'] ?>gr</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td><?php echo $detailproduk['deskripsi_produk']; ?></td>
            </tr>
            <tr>
                <th>Stok</th>
                <td><?php echo $detailproduk['stok_produk']; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row mb-4">
    <?php foreach ($fotoproduk as $key => $data) : ?>
        <div class="col-md-6 col-xl-4 mt-3">
            <div class="card bg-dark border-0 text-white">
                <img class="card-img" src="../foto_produk/<?php echo $data['nama_produk_foto']; ?>" alt="Card image" />
            </div>
            <a href="index.php?halaman=hapus_fotoproduk&idfoto=<?php echo $data['id_produk_foto']; ?>&idproduk=<?php echo $id_produk; ?>" class="btn btn-danger btn-sm mt-2">
                <i class="bx bxs-trash me-1"></i>Hapus
            </a>
        </div>
    <?php endforeach ?>
</div>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="basic-default-fullname">Upload Gambar</label>
        <input type="file" class="form-control" name="fotomu">
        <button name="upload" class="btn btn-primary mt-3"><i class='bx bxs-save me-1'></i>Upload</button>
    </div>
</form>

<?php
if (isset($_POST['upload'])) {
    $lokasi_foto = $_FILES['fotomu']['tmp_name'];
    $nama_foto = $_FILES['fotomu']['name'];

    $nama_foto = date("YmdHis") . $nama_foto;

    // Upload foto
    move_uploaded_file($lokasi_foto, "../foto_produk/" . $nama_foto);
    $koneksi->query("INSERT INTO produk_foto (id_produk,nama_produk_foto) VALUES ('$id_produk','$nama_foto') ");

    echo "<script>alert('Foto produk berhasil disimpan');</script>";
    echo "<script>location='index.php?halaman=detail_produk&id=$id_produk';</script>";
}
?>