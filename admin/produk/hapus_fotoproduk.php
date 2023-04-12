<?php
$id_foto = $_GET['idfoto'];
$id_produk = $_GET['idproduk'];

// Ambil data produk_foto
$ambil_foto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto = '$id_foto'");
$detail_foto = $ambil_foto->fetch_assoc();

$nama_filefoto = $detail_foto['nama_produk_foto'];

// Hapus file foto dari folder
unlink("../foto_produk/" . $nama_filefoto);
// Hapus juga data foto di databasesnya
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto = '$id_foto'");

echo "<script>alert('Foto produk berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=detail_produk&id=$id_produk';</script>";
