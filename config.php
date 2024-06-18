<?php 

$koneksi = mysqli_connect("localhost", "root", "", "uas_posyandu");

// if (mysqli_connect_error()){
//     echo "Gagal koneksi ke database";
// } else{
//     echo "Berhasil koneksi ke database";
// }

$main_url = "http://localhost/posgenville/";

function uploadimg($url) {
    $namafile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmp = $_FILES['image']['tmp_name'];

    //cek file yg diupload
    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = explode('.', $namafile);
    $fileExtension = strtolower(end($fileExtension));
    if (!in_array($fileExtension, $validExtension)) {
        header("location:" . $url . '?msg=notimage' );
        die;
    }

    //cek ukuran gambar
    if ($ukuran > 1000000) {
        header("location:" . $url . '?msg=oversize');
        die;
    }

    //generate nama file gambar
    if ($url == 'profile-posyandu.php') {
        $namafilebaru = rand(0, 50) . '-bgLogin.' . $fileExtension;
    } else {
        $namafilebaru = rand(10, 1000) . '-' . $namafile;
    }

    //upload gambar
    move_uploaded_file($tmp, "../asset/image/" . $namafilebaru);
    return $namafilebaru;

}

?>