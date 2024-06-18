<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $id = $_POST['id_perkembangan'];
    $petugas = $_POST['petugas'];
    $tgl_periksa = htmlspecialchars($_POST['tgl_periksa']);
    $nama_balita = $_POST['nama_balita'];
    $berat = htmlspecialchars($_POST['berat_badan']);
    $tinggi = htmlspecialchars($_POST['tinggi_badan']);
    $status =  $status = $_POST['status'];

    mysqli_query($koneksi, "INSERT INTO tbl_perkembangan VALUES('$id', '$petugas', '$tgl_periksa', '$nama_balita', '$berat', '$tinggi', '$status')");

    header("location:perkembangan.php?msg=added");
    return;
}

if (isset($_POST['update'])) {
    $id = $_POST['id_perkembangan'];
    $petugas = $_POST['petugas'];
    $tgl_periksa = htmlspecialchars($_POST['tgl_periksa']);
    $nama_balita = $_POST['nama_balita'];
    $berat = htmlspecialchars($_POST['berat_badan']);
    $tinggi = htmlspecialchars($_POST['tinggi_badan']);
    $status = $_POST['status'];

    mysqli_query($koneksi, "UPDATE tbl_perkembangan SET 
        petugas                 = '$petugas',
        tgl_periksa             = '$tgl_periksa',
        nama_balita             = '$nama_balita',
        berat_badan             = '$berat',
        tinggi_badan            = '$tinggi',
        status                  = '$status'
        WHERE id_perkembangan   = '$id'
    ");

    header("location:perkembangan.php?msg=updated");
    return;
}

?>