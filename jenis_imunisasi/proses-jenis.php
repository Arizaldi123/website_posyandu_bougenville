<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $imunisasi = htmlspecialchars($_POST['imunisasi']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    mysqli_query($koneksi, "INSERT INTO tbl_jenis_imunisasi VALUES (null, '$imunisasi', '$keterangan')");
    header("location:jenis-imunisasi.php?msg=added");
    return;
}

if (isset($_POST['update'])) {
    $id = $_POST['id_jenis'];
    $imunisasi = htmlspecialchars($_POST['imunisasi']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    $sqlJenis = mysqli_query($koneksi, "SELECT * FROM tbl_jenis_imunisasi WHERE id_jenis = $id");
    $data = mysqli_fetch_array($sqlJenis);

    mysqli_query($koneksi, "UPDATE tbl_jenis_imunisasi SET 
        imunisasi      = '$imunisasi',
        keterangan     = '$keterangan'
        WHERE id_jenis = '$id'
    ");

    header("location:jenis-imunisasi.php?msg=updated");
    return;
}

?>