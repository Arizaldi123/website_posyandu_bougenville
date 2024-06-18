<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if(isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = trim(htmlspecialchars($_POST['nama']));
    $email = trim(htmlspecialchars($_POST['email']));
    $no_telp = trim(htmlspecialchars($_POST['no_telp']));
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $gbr = trim(htmlspecialchars($_POST['gbrLama']));

    if ($_FILES['image']['error'] === 4) {
        $gbrPosyandu = $gbr;
    } else {
        $url = 'profile-posyandu.php';
        $gbrPosyandu = uploadimg($url);
        @unlink('../asset/image/' . $gbr);
    }

    //update data
    mysqli_query($koneksi, "UPDATE tbl_posyandu SET
        nama = '$nama',
        email = '$email',
        no_telp = '$no_telp',
        alamat = '$alamat',
        gambar = '$gbrPosyandu'
        WHERE id = $id
    ");

    header("location:profile-posyandu.php?msg=updated");
    return;
}

?>