<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Ibu - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id = $_GET['id_ibu'];

$queryIbu = mysqli_query($koneksi, "SELECT * FROM tbl_ibu WHERE id_ibu = $id");

$data = mysqli_fetch_array($queryIbu);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Update Ibu</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="ibu.php">Data Ibu</a></li>
                            <li class="breadcrumb-item active">Update Ibu</li>
                        </ol>
                        <form action="proses-ibu.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-pen-to-square"></i><span class="h5 my-2"> Update Ibu</span>
                                <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                                <a href="ibu.php" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Cancel</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="hidden" name="id_ibu" value="<?= $data['id_ibu'] ?>">
                                    <div class="mb-3 row">
                                            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                            <label for="nik" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="nik" pattern="[0-9]{16,16}" title="minimal dan maksimal 16 angka" class="form-control border-0 border-bottom ps-2" value="<?= $data['nik'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <label for="nama" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="nama" class="form-control border-0 border-bottom ps-2" value="<?= $data['nama'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                                            <label for="no_telp" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="tel" name="no_telp" pattern="[0-9]{11,13}" title="minimal 11 angka dan maksimal 13 angka" class="form-control border-0 border-bottom ps-2" value="<?= $data['no_telp'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <label for="email" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="email" name="email" class="form-control border-0 border-bottom ps-2" value="<?= $data['email'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <label for="alamat" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                                <textarea name="alamat" id="alamat" cols="65" rows="3" class="form control border-0 border-bottom" required><?= $data['alamat'] ?></textarea>
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