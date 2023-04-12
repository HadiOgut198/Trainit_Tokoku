<?php
$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori
WHERE id_produk = '$_GET[id]'");
// $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
$edit = $ambil->fetch_assoc();
?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class='bx bxs-edit me-1'></i>Form edit produk</h5>
                <small class="text-muted float-end">Edit products</small>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Kategori</label>
                        <select class="form-select" name="id_kategori" id="exampleFormControlSelect1" aria-label="Default select example">
                            <option value="<?php echo $edit['id_kategori'] ?>" selected>
                                <?php echo $edit['nama_kategori']; ?>
                            </option>
                            <option value=""> -- Pilih Kategori-- </option>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM kategori");
                            while ($kategori = $ambil->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $edit['nama_produk']; ?>" placeholder="Nama produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Harga (Rp)</label>
                        <input type="number" class="form-control" name="harga" value="<?php echo $edit['harga_produk']; ?>" placeholder="Harga produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Berat (Gr)</label>
                        <input type="number" class="form-control" name="berat" value="<?php echo $edit['berat_produk']; ?>" placeholder="Berat produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Stok</label>
                        <input type="number" class="form-control" name="stok" value="<?php echo $edit['stok_produk']; ?>" placeholder="Berat produk" />
                    </div>

                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                        <img src="../foto_produk/<?php echo $edit['foto_produk']; ?>" alt="Gambar" class="d-block rounded" height="100" width="100" />
                        <div class="button-wrapper">
                            <label class="form-label" for="basic-default-fullname">Ganti Foto</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" placeholder="Masukan text..."><?php echo $edit['deskripsi_produk']; ?></textarea>
                    </div>

                    <button name="update" class="btn btn-primary"><i class='bx bx-save me-1'></i>Update</button>
                </form>

                <?php
                if (isset($_POST['update'])) {
                    $namafoto = $_FILES['foto']['name'];
                    $lokasifoto = $_FILES['foto']['tmp_name'];

                    // Jika gambar dirubah
                    if (!empty($lokasifoto)) {
                        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

                        $koneksi->query("UPDATE produk SET id_kategori='$_POST[id_kategori]',nama_produk='$_POST[nama]',
                                harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',stok_produk='$_POST[stok]',
                                foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]' 
                            WHERE id_produk='$_GET[id]'");
                    } else {
                        $koneksi->query("UPDATE produk SET id_kategori='$_POST[id_kategori]',nama_produk='$_POST[nama]',
                                harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',stok_produk='$_POST[stok]',
                                deskripsi_produk='$_POST[deskripsi]'
                            WHERE id_produk = '$_GET[id]'");
                    }

                    echo "<script>alert('Data produk berhasil diubah');</script>";
                    echo "<script>location='index.php?halaman=produk';</script>";
                }
                ?>

            </div>
        </div>
    </div>
</div>