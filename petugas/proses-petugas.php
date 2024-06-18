<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $nama = trim(htmlspecialchars($_POST['nama']));
    $level = $_POST['level'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $notelp = trim(htmlspecialchars($_POST['notelp']));
    $password = 1234;
    $pass = password_hash($password, PASSWORD_DEFAULT);

    //cek username
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0 ) {
        header("location:tambah-petugas.php?msg=cancel");
        return;
    }

    mysqli_query($koneksi, "INSERT INTO tbl_petugas VALUES(null, '$username', '$pass', '$nama', '$alamat', '$level', '$notelp')");

    header("location:petugas.php?msg=added");
    return;
}

?>