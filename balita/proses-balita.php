<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $id_balita = $_POST['id_balita'];
    $nik = htmlspecialchars($_POST['nik']);
    $nama = htmlspecialchars($_POST['nama']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $umur = htmlspecialchars($_POST['umur']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $ibu = $_POST['ibu'];

    mysqli_query($koneksi, "INSERT INTO tbl_balita VALUES('$id_balita', '$nik', '$nama', '$tgl_lahir', '$umur', '$jenis_kelamin', '$ibu')");

    header("location:balita.php?msg=added");
    return;

} else if (isset($_POST['update'])) {
    $id_balita = $_POST['id_balita'];
    $nik = htmlspecialchars($_POST['nik']);
    $nama = htmlspecialchars($_POST['nama']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $umur = htmlspecialchars($_POST['umur']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $ibu = $_POST['ibu'];

    mysqli_query($koneksi, "UPDATE tbl_balita SET 
        nik           = '$nik',
        nama          = '$nama',
        tgl_lahir     = '$tgl_lahir',
        umur          = '$umur',
        jenis_kelamin = '$jenis_kelamin',
        ibu           = '$ibu'
        WHERE id_balita = '$id_balita'
    ");

    header("location:balita.php?msg=updated");
    return;
}

?>