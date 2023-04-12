<?php 
    session_start();

    // Mendapatkan id_produk dari URL
    $id_produk = $_GET['id'];

    // Jika sudah ada produk itu dikeranjang, maka produk itu jumlahnya di + 1
    if(isset($_SESSION['keranjang'][$id_produk]))
    {
        $_SESSION['keranjang'][$id_produk] += 1;
    }
    // Selain itu (belum ada di keranjang), maka produk itu dianggap dibeli 1
    else
    {
        $_SESSION['keranjang']   [$id_produk] = 1;
    }

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";

    echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
    echo "<script>location='keranjang.php';</script>";

?>