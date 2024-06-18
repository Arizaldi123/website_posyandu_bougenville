<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$id = $_GET["id_jenis"];

mysqli_query($koneksi, "DELETE FROM tbl_jenis_imunisasi WHERE id_jenis = $id");

header("location:jenis-imunisasi.php?msg=deleted");

?>