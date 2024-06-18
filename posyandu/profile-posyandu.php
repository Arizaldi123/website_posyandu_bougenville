<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Profile Posyandu - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> Update data posyandu gagal, file yang anda upload bukan gambar..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i> Update data posyandu gagal, maximal ukuran gambar 1 MB..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data posyandu berhasil diperbarui..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

$posyandu = mysqli_query($koneksi,"SELECT * FROM tbl_posyandu WHERE id = 1");
$data = mysqli_fetch_array($posyandu);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Profile Posyandu</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Profile Posyandu</li>
                        </ol>
                        <form action="proses-posyandu.php" method="POST" enctype="multipart/form-data">
                            <?php 
                                if ($msg !== '') {
                                    echo $alert;
                                }
                            ?>
                        <div class="card">
                        <div class="card-header">
                            <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Data Posyandu</span>
                            <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            <a href="../index.php" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Batal</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 text-center px-5">
                                    <input type="hidden" name="gbrLama" value="<?= $data['gambar'] ?>">
                                    <img src="../asset/image/<?= $data['gambar'] ?>" alt="gambar posyandu" class="mb-3" width="100%" height="50%">
                                    <input type="file" name="image" class="form-control form-control-sm">
                                    <small class="text-secondary">Pilih gambar login dengan format PNG, JPG, atau JPEG dan ukuran maksimal 1 MB</small>
                                </div>
                                <div class="col-8">
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label" style="white-space: nowrap;">Nama Posyandu</label>
                                    <label for="nama" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                    <input type="text" class="form-control border-0 border-bottom" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <label for="email" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                    <input type="email" class="form-control border-0 border-bottom" id="email" name="email" value="<?= $data['email'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                                    <label for="no_telp" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                    <input type="tel" name="no_telp" pattern="[0-9]{11,13}" title="minimal 11 angka dan maksimal 13 angka" class="form-control border-0 border-bottom ps-2" id="no_telp" value="<?= $data['no_telp'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </form>
                    </div>
                </main>

<?php 
require_once "../template/footer.php";
?>