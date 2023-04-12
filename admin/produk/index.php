<a href="index.php?halaman=tambah_produk" class="btn btn-outline-primary mb-4">
    <span class="tf-icons bx bx-plus-circle me-1"></span>Tambah produk
</a>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Produk</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Berat</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori");
                while ($pecah = $ambil->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>

                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li>
                                    <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" alt="Gambar" class="rounded" width="70">
                                </li>
                            </ul>
                        </td>

                        <td><strong><?php echo $pecah['nama_kategori']; ?></strong></td>
                        <td><?php echo $pecah['nama_produk']; ?></td>

                        <td>Rp<?php echo number_format($pecah['harga_produk']); ?></td>
                        <td><?php echo $pecah['berat_produk']; ?>/gr</td>

                        <td><span class="badge bg-label-success me-1">Tersedia</span></td>

                        <td>
                            <a href="index.php?halaman=detail_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning btn-sm"><i class="bx bx-eye me-1"></i>Detail</a>
                            <a href="index.php?halaman=edit_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-success btn-sm"><i class='bx bxs-edit me-1'></i>Edit</a>
                            <a href="index.php?halaman=hapus_produk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger btn-sm"><i class='bx bx-trash me-1'></i>Hapus</a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->