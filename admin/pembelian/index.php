<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Pembelian</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status pembelian</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.
                        id_pelanggan = pelanggan.id_pelanggan");
                while ($pecah = $ambil->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>

                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                    <img src="template/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                </li>
                            </ul>
                        </td>

                        <td><strong><?php echo $pecah['nama_pelanggan']; ?></strong></td>

                        <td><?php echo $pecah['tgl_pembelian']; ?></td>

                        <td>Rp<?php echo number_format($pecah['total_pembelian']); ?></td>

                        <td>
                            <?php if ($pecah['status_pembelian'] == "pending") : ?>
                                <span class="badge bg-label-danger me-1"><i class='bx bx-info-circle bx-flashing me-1'></i><?php echo $pecah['status_pembelian']; ?></span>
                            <?php else : ?>
                                <span class="badge bg-label-success me-1"><i class='bx bx-check-circle bx-flashing me-1'></i><?php echo $pecah['status_pembelian']; ?></span>
                            <?php endif ?>
                        </td>

                        <td>
                            <a href="index.php?halaman=detail_pembelian&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info btn-sm">Detail</a>
                            <?php if ($pecah['status_pembelian'] == "Sudah kirim pembayaran") : ?>
                                <a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success btn-sm"><i class="bx bx-credit-card me-1"></i>Konfirmasi</a>
                            <?php endif ?>
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