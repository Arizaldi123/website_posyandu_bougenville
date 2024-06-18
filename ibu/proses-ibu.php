<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $nik = htmlspecialchars($_POST['nik']);
    $nama = htmlspecialchars($_POST['nama']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);

    //cek NIK
    $cekNik = mysqli_query($koneksi, "SELECT nik FROM tbl_ibu WHERE nik ='$nik'");
    if (mysqli_num_rows($cekNik) > 0) {
        header("location:tambah-ibu.php?msg=cancel");
        return;
    }

    mysqli_query($koneksi, "INSERT INTO tbl_ibu VALUES (null, '$nik', '$nama', '$no_telp', '$email', '$alamat')");
    header("location:tambah-ibu.php?msg=added");
    return;
}

if (isset($_POST['update'])) {
    $id = $_POST['id_ibu'];
    $nik = htmlspecialchars($_POST['nik']);
    $nama = htmlspecialchars($_POST['nama']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $sqlIbu = mysqli_query($koneksi, "SELECT * FROM tbl_ibu WHERE id_ibu = $id");
    $data = mysqli_fetch_array($sqlIbu);
    $curNIK = $data['nik'];

    $newNIK = mysqli_query($koneksi, "SELECT nik FROM tbl_ibu WHERE nik = '$nik'");

    if ($nik !== $curNIK) {
        if (mysqli_num_rows($newNIK) > 0) {
            header("location:ibu.php?msg=cancel");
            return;
        }
    }

    mysqli_query($koneksi, "UPDATE tbl_ibu SET 
        nik           = '$nik',
        nama          = '$nama',
        no_telp       = '$no_telp',
        email         = '$email',
        alamat        = '$alamat'
        WHERE id_ibu = '$id'
    ");

    header("location:ibu.php?msg=updated");
    return;
}

?>