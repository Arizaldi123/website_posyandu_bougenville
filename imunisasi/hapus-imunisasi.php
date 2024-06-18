<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$id_imunisasi = $_GET['id_imunisasi'];

mysqli_query($koneksi, "DELETE FROM tbl_imunisasi WHERE id_imunisasi = '$id_imunisasi'");

header("location:imunisasi.php?msg=deleted");

?>