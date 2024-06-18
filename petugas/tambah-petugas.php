<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

// Ensure the user's level is available
if (!isset($_SESSION["ssLevel"]) || $_SESSION["ssLevel"] != 1) {
    header("location:../index.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Petugas - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-xmark"></i> Tambah petugas gagal, username sudah ada..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Petugas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="petugas.php">Data Petugas</a></li>
                <li class="breadcrumb-item active">Tambah Petugas</li>
            </ol>
            <form action="proses-petugas.php" method="POST">
                <?php 
                    if ($msg !== '') {
                        echo $alert;
                    }
                ?>
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Tambah Petugas</span>
                    <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="reset" name="reset" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Reset</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                <input type="text" pattern="[A-Za-z0-9]{3,}" title="minimal 3 karakter kombinasi huruf besar, huruf kecil, dan angka" class="form-control border-0 border-bottom" id="username" name="username" maxlength="20" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                <input type="text" class="form-control border-0 border-bottom" id="nama" name="nama" maxlength="20" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="level" class="col-sm-2 col-form-label">Jabatan</label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <select name="level" id="level" class="form-select border-0 border-bottom" required>
                                        <option value="" selected>---Pilih Jabatan---</option>
                                        <option value="1">Ketua Kader</option>
                                        <option value="2">Anggota Kader</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Alamat</label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" placeholder="domisili" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="notelp" class="col-sm-2 col-form-label">No.Telp</label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                <input type="tel" name="notelp" pattern="[0-9]{11,13}" title="minimal 11 angka dan maksimal 13 angka" class="form-control border-0 border-bottom ps-2" id="notelp" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </main>

<?php 
require_once "../template/footer.php";
?>
