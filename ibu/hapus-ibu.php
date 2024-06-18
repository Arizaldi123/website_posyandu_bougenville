<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$id = $_GET["id_ibu"];

mysqli_query($koneksi, "DELETE FROM tbl_ibu WHERE id_ibu = $id");

header("location:ibu.php?msg=deleted");

?>