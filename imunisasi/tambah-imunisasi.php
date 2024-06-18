<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Data Imunisasi - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$queryId = mysqli_query($koneksi, "SELECT max(id_imunisasi) as maxid FROM tbl_imunisasi");
$data = mysqli_fetch_array($queryId);
$maxid = $data["maxid"];

$noUrut = (int) substr($maxid, 3, 3);
$noUrut++;
$maxid = "IMU".sprintf("%03s", $noUrut);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Data Imunisasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="imunisasi.php">Data Imunisasi</a></li>
                            <li class="breadcrumb-item active">Tambah Data Imunisasi</li>
                        </ol>
                        <form action="proses-imunisasi.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-square-plus"></i><span class="h5 my-2"> Tambah Data Imunisasi</span>
                                <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                <button type="reset" name="reset" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Reset</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3 row">
                                            <label for="id_imunisasi" class="col-sm-2 col-form-label">ID</label>
                                            <label for="id_imunisasi" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="id_imunisasi" class="form-control-plaintext border-bottom ps-2" id="id_imunisasi" value="<?= $maxid ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tgl_imunisasi" class="col-sm-2 col-form-label" style="white-space: nowrap;">Tgl Imunisasi</label>
                                            <label for="tgl_imunisasi" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="date" name="tgl_imunisasi" class="form-control border-0 border-bottom ps-2" id="tgl_imunisasi" value="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama_balita" class="col-sm-2 col-form-label" style="white-space: nowrap;">Nama Balita</label>
                                            <label for="nama_balita" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <select name="nama_balita" id="nama_balita" class="form-select" required>
                                                <option value="" selected>--Pilih Nama Balita--</option>
                                                <?php
                                                    $queryBalita = mysqli_query($koneksi, "SELECT * FROM tbl_balita");
                                                    while ($dataBalita = mysqli_fetch_array($queryBalita)) { ?>
                                                        <option value="<?= $dataBalita['nama'] ?>"><?= $dataBalita['nama'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="imunisasi" class="col-sm-2 col-form-label" style="white-space: nowrap;">Jenis Imunisasi</label>
                                            <label for="imunisasi" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <select name="imunisasi" id="imunisasi" class="form-select" required>
                                                <option value="" selected>--Pilih Jenis Imunisasi--</option>
                                                <?php
                                                    $queryJenis = mysqli_query($koneksi, "SELECT * FROM tbl_jenis_imunisasi");
                                                    while ($dataJenis = mysqli_fetch_array($queryJenis)) { ?>
                                                        <option value="<?= $dataJenis['imunisasi'] ?>"><?= $dataJenis['imunisasi'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="vitamin" class="col-sm-2 col-form-label" style="white-space: nowrap;">Saran Vitamin</label>
                                            <label for="vitamin" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="vitamin" class="form-control border-0 border-bottom ps-2" id="vitamin" value="" required>
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