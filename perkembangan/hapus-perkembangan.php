<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$id_perkembangan = $_GET['id_perkembangan'];

mysqli_query($koneksi, "DELETE FROM tbl_perkembangan WHERE id_perkembangan = '$id_perkembangan'");

header("location:perkembangan.php?msg=deleted");

?>