<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Jenis Imunisasi - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id = $_GET['id_jenis'];

$queryJenis = mysqli_query($koneksi, "SELECT * FROM tbl_jenis_imunisasi WHERE id_jenis = $id");

$data = mysqli_fetch_array($queryJenis);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Update Jenis Imunisasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="jenis-imunisasi.php">Jenis Imunisasi</a></li>
                            <li class="breadcrumb-item active">Update Jenis Imunisasi</li>
                        </ol>
                        <form action="proses-jenis.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-pen-to-square"></i><span class="h5 my-2"> Update Jenis Imunisasi</span>
                                <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                                <a href="jenis-imunisasi.php" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Cancel</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="hidden" name="id_jenis" value="<?= $data['id_jenis'] ?>">
                                        <div class="mb-3 row">
                                            <label for="imunisasi" class="col-sm-2 col-form-label" style="white-space: nowrap;">Nama Imunisasi</label>
                                            <label for="imunisasi" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="imunisasi" class="form-control border-0 border-bottom ps-2" value="<?= $data['imunisasi'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                            <label for="keterangan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                                <textarea name="keterangan" id="keterangan" cols="65" rows="3" class="form control border-0 border-bottom" required><?= $data['keterangan'] ?></textarea>
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