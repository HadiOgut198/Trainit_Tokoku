<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form tambah produk</h5>
                <small class="text-muted float-end">Create products</small>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Kategori</label>
                        <select class="form-select" name="id_kategori" id="exampleFormControlSelect1" aria-label="Default select example">
                            <option selected> -- Pilih Kategori-- </option>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM kategori");
                            while ($kategori = $ambil->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $kategori['id_kategori'] ?>">
                                    <?php echo $kategori['nama_kategori']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Harga (Rp)</label>
                        <input type="number" class="form-control" name="harga" placeholder="Harga produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Berat (Gr)</label>
                        <input type="number" class="form-control" name="berat" placeholder="Berat produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Stok</label>
                        <input type="number" class="form-control" name="stok" placeholder="Stok produk" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" placeholder="Masukan text..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Gambar</label>
                        <div class="letak-input" style="margin-bottom: 10px;">
                            <input type="file" class="form-control" name="foto[]">
                        </div>
                        <span class="btn btn-outline-danger btn-tambah"><i class='bx bxs-camera-plus me-1'></i></span>
                    </div>

                    <button name="simpan" class="btn btn-primary"><i class='bx bx-save me-1'></i>Simpan</button>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $namanama_foto = $_FILES['foto']['name'];
                    $lokasilokasi_foto = $_FILES['foto']['tmp_name'];
                    move_uploaded_file($lokasilokasi_foto[0], "../foto_produk/" . $namanama_foto[0]);

                    $koneksi->query("INSERT INTO produk (id_kategori, nama_produk, harga_produk, berat_produk, stok_produk, foto_produk, deskripsi_produk)
                    VALUES ('$_POST[id_kategori]','$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$_POST[stok]', '$namanama_foto[0]', '$_POST[deskripsi]')");

                    // Mendapatkan id_produk barusan
                    $id_produk_barusan = $koneksi->insert_id;

                    foreach ($namanama_foto as $key => $tiap_nama) {
                        $tiap_lokasi = $lokasilokasi_foto[$key];
                        move_uploaded_file($tiap_lokasi, "../foto_produk/" . $tiap_nama);

                        // Simpan ke database mysql (tapi kita perlu tau id_produknya berapa)
                        $koneksi->query("INSERT INTO produk_foto (id_produk,nama_produk_foto)
                        VALUES ('$id_produk_barusan','$tiap_nama')");
                    }

                    echo "<div class='alert alert-success'>Produk berhasil disimpan</div>";
                    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
                }
                ?>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".btn-tambah").on("click", function() {
            $(".letak-input").append("<input type='file' class='form-control mt-2' name='foto[]'>");
        })
    })
</script>