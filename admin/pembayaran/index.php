<?php
// Mendapatkan id_pembelian dari URL
$id_pembelian = $_GET['id'];

// Mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-nowrap">Nama Pelanggan :</th>
                        <td class="text-nowrap"><?php echo $detail['nama']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-nowrap">Nama Bank :</th>
                        <td class="text-nowrap"><?php echo $detail['bank']; ?></td>
                    </tr>
                    <tr>
                        <th class="text-nowrap">Jumlah :</th>
                        <td class="text-nowrap">Rp<?php echo number_format($detail['jumlah_pembayaran']); ?></td>
                    </tr>
                    <tr>
                        <th class="text-nowrap">Dari Tanggal :</th>
                        <td class="text-nowrap"><?php echo $detail['tanggal_pembayaran']; ?></td>
                    </tr>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <h5>Bukti pembayaran :</h5>
                        <hr class="my-0 mb-3" />
                        <div class="card">
                            <img class="card-img-top" src="../bukti_pembayaran/<?php echo $detail['bukti']; ?>" alt="Card image cap" />
                        </div>
                    </div>
                </thead>
            </table>
        </div>

        <!-- <form>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-name" placeholder="John Doe" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Company</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <input type="text" id="basic-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2" />
                        <span class="input-group-text" id="basic-default-email2">@example.com</span>
                    </div>
                    <div class="form-text">You can use letters, numbers & periods</div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone No</label>
                <div class="col-sm-10">
                    <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-message">Message</label>
                <div class="col-sm-10">
                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form> -->
    </div>

    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">No Resi Pembayaran</label>
                <input type="number" class="form-control" id="basic-default-fullname" name="resi" placeholder="No Resi" />
            </div>

            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Status Pengiriman</label>
                <select class="form-select" name="status" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected> -- Pilih -- </option>
                    <option value="lunas">Lunas</option>
                    <option value="barang dikirim">Barang Dikirim</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>
            <button class="btn btn-primary" name="proses"><i class='bx bx-chevrons-right me-1'></i>Proses</button>
        </form>
    </div>
</div>

<?php
if (isset($_POST['proses'])) {
    // Update No Resi
    $resi = $_POST['resi'];
    $status = $_POST['status'];
    $koneksi->query("UPDATE pembelian SET resi_pengiriman = '$resi', status_pembelian = '$status'
    WHERE id_pembelian = '$id_pembelian'");
    echo "<script>alert('Data pembelian berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian'</script>";
}
?>