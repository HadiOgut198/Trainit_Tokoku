<?php
$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";

if (isset($_POST['lihat'])) {
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
    $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON
    pm.id_pelanggan=pl.id_pelanggan WHERE tgl_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }

    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";
}
?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Laporan pembelian </h5>
                <small class="text-muted float-end">Dari <?php echo date($tgl_mulai); ?> hingga <?php echo $tgl_selesai; ?></small>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Dari Tanggal</label>
                                <input type="date" class="form-control" name="tglm" id="basic-default-fullname" value="<?php echo $tgl_mulai; ?>" require />
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="tgls" id="basic-default-fullname" value="<?php echo $tgl_selesai; ?>" require />
                            </div>
                        </div>

                        <div class="col-md-2 mt-1"><br>
                            <button name="lihat" class="btn btn-primary">Lihat</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $total = 0;
                        foreach ($semuadata as $key => $data) :
                            $total += $data['total_pembelian'];
                        ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $data['nama_pelanggan']; ?></td>
                                <td><?php echo $data['tgl_pembelian']; ?></td>
                                <td>Rp<?php echo number_format($data['total_pembelian']); ?></td>
                                <td>
                                    <span class="badge bg-label-success"><?php echo $data['status_pembelian']; ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <th colspan="3">Total :</th>
                            <th>Rp<?php echo number_format($total); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>