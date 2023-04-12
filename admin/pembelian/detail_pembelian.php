<?php
    
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
        ON pembelian.id_pelanggan = pelanggan.id_pelanggan
        WHERE pembelian.id_pembelian='$_GET[id]'");
    $detail = $ambil->fetch_assoc();

?> 

<!-- <pre><?php print_r($detail); ?></pre> -->

<div class="row">
    <div class="col-xl-2">
        <div class="card shadow-none bg-transparent border border-primary">
            <div class="card-header">Nama : <?php echo $detail['nama_pelanggan']; ?></div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card shadow-none bg-transparent border border-primary">
            <div class="card-header">Email : <?php echo $detail['email_pelanggan']; ?></div>
        </div>
    </div>

    <div class="col-xl-2">
        <div class="card shadow-none bg-transparent border border-primary">
            <div class="card-header">Telp : <?php echo $detail['telepon_pelanggan']; ?></div>
        </div>
    </div>

    <div class="col-xl-2">
        <div class="card shadow-none bg-transparent border border-primary">
            <div class="card-header">Tanggal : <?php echo $detail['tgl_pembelian']; ?></div>
        </div>
    </div>

    <div class="col-xl-2">
        <div class="card shadow-none bg-transparent border border-primary">
            <div class="card-header">Total : Rp<?php echo number_format($detail['total_pembelian']); ?></div>
        </div>
    </div>

</div>

<!-- Basic Bootstrap Table -->
<div class="card mt-4">
    <h5 class="card-header">Detail pembelian</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Produk </th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php 
                    $no = 1;
                    $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
                        pembelian_produk.id_produk = produk.id_produk
                        WHERE pembelian_produk.id_pembelian = '$_GET[id]'");
                    while($pecah = $ambil->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><strong><?php echo $pecah['nama_produk']; ?></strong></td>

                    <td>Rp<?php echo number_format($pecah['harga_produk']); ?></td>
                    <td><?php echo $pecah['jumlah']; ?>/Pcs</td>
                    <td>Rp<?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?></td>
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