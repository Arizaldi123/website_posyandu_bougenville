<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$id_balita = $_GET['id_balita'];

mysqli_query($koneksi, "DELETE FROM tbl_balita WHERE id_balita = '$id_balita'");

header("location:balita.php?msg=deleted")

?>