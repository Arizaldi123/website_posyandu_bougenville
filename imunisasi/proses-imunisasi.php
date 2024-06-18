<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $id = $_POST['id_imunisasi'];
    $tgl_imunisasi = htmlspecialchars($_POST['tgl_imunisasi']);
    $nama_balita = $_POST['nama_balita'];
    $imunisasi = $_POST['imunisasi'];
    $vitamin = htmlspecialchars($_POST['vitamin']);

    mysqli_query($koneksi, "INSERT INTO tbl_imunisasi VALUES('$id', '$tgl_imunisasi', '$nama_balita', '$imunisasi', '$vitamin')");

    header("location:imunisasi.php?msg=added");
    return;
}

if (isset($_POST['update'])) {
    $id = $_POST['id_imunisasi'];
    $tgl_imunisasi = htmlspecialchars($_POST['tgl_imunisasi']);
    $nama_balita = $_POST['nama_balita'];
    $imunisasi = $_POST['imunisasi'];
    $vitamin = htmlspecialchars($_POST['vitamin']);

    mysqli_query($koneksi, "UPDATE tbl_imunisasi SET 
        tgl_imunisasi       = '$tgl_imunisasi',
        nama_balita         = '$nama_balita',
        imunisasi           = '$imunisasi',
        vitamin             = '$vitamin'
        WHERE id_imunisasi  = '$id'
    ");

    header("location:imunisasi.php?msg=updated");
    return;
}

?>