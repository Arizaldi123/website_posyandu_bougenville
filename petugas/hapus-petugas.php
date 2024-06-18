<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$id_petugas = $_GET['id_petugas'];

mysqli_query($koneksi, "DELETE FROM tbl_petugas WHERE id_petugas = '$id_petugas'");

header("location:petugas.php?msg=deleted");

?>