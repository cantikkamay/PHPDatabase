<?php
// Mengecek apakah tombol edit telah diklik
if (isset($_POST['edit'])) {
    // Buat koneksi dengan database
    include("koneksi.php");

    // Membuat variabel untuk menampung data dari form edit
    $id = $_POST['idDosen'];
    $namaDosen = $_POST['namaDosen'];
    $noHP = $_POST['noHP'];

    // Buat dan jalankan query UPDATE
    $query = "UPDATE t_dosen SET namaDosen = '$namaDosen', noHP = '$noHP' WHERE idDosen = '$id'";
    $result = mysqli_query($link, $query);

    // Periksa hasil query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($link) . " - " . mysqli_error($link));
    }

    // Lakukan redirect ke halaman viewdosen.php
    header("Location: viewdosen.php");
    exit();
}
?>