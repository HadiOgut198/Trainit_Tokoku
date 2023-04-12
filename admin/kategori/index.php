<a href="" class="btn btn-outline-primary mb-4">
    <span class="tf-icons bx bx-plus-circle me-1"></span>Tambah Kategori
</a>

<?php
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $semuadata[] = $tiap;
}
?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Kategori Produk</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                foreach ($semuadata as $key => $data) :
                ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><strong><?php echo $data['nama_kategori']; ?></strong></td>
                        <td>
                            <a href="" class="btn btn-success btn-sm"><i class='bx bxs-edit me-1'></i>Edit</a>
                            <a href="" class="btn btn-danger btn-sm"><i class='bx bxs-trash me-1'></i>Hapus</a>
                        </td>
                    </tr>
                <?php
                endforeach
                ?>
            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->