<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Pelanggan</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
        <thead>
            <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php 
                $no = 1;
                $ambil = $koneksi->query("SELECT * FROM pelanggan");
                while($pecah = $ambil->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>

                <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                        <li
                            data-bs-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-bs-placement="top"
                            class="avatar avatar-xs pull-up"
                            title="Lilian Fuller">
                            <img src="template/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                        </li>
                    </ul>
                </td>

                <td><strong><?php echo $pecah['nama_pelanggan']; ?></strong></td>

                <td><?php echo $pecah['email_pelanggan']; ?></td>
                <td><?php echo $pecah['telepon_pelanggan']; ?></td>
                
                <td>
                    <a href="" class="btn btn-success btn-sm">Edit</a>
                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
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