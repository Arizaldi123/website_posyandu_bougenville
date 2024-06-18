<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Perkembangan Balita - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$queryId = mysqli_query($koneksi, "SELECT max(id_perkembangan) as maxid FROM tbl_perkembangan");
$data = mysqli_fetch_array($queryId);
$maxid = $data["maxid"];

$noUrut = (int) substr($maxid, 3, 3);
$noUrut++;
$maxid = "PRB".sprintf("%03s", $noUrut);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Perkembangan Balita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="perkembangan.php">Data Perkembangan</a></li>
                            <li class="breadcrumb-item active">Tambah Perkembangan Balita</li>
                        </ol>
                        <form action="proses-perkembangan.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-square-plus"></i><span class="h5 my-2"> Tambah Perkembangan Balita</span>
                                <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                <button type="reset" name="reset" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Reset</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3 row">
                                            <label for="id_perkembangan" class="col-sm-2 col-form-label">ID</label>
                                            <label for="id_perkembangan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="id_perkembangan" class="form-control-plaintext border-bottom ps-2" id="id_perkembangan" value="<?= $maxid ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="petugas" class="col-sm-2 col-form-label" style="white-space: nowrap;">Petugas Periksa</label>
                                            <label for="petugas" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <select name="petugas" id="petugas" class="form-select" required>
                                                <option value="" selected>--Pilih Nama Petugas--</option>
                                                <?php
                                                    $queryPetugas = mysqli_query($koneksi, "SELECT * FROM tbl_petugas");
                                                    while ($dataPetugas = mysqli_fetch_array($queryPetugas)) { ?>
                                                        <option value="<?= $dataPetugas['nama_petugas'] ?>"><?= $dataPetugas['nama_petugas'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tgl_periksa" class="col-sm-2 col-form-label" style="white-space: nowrap;">Tanggal Periksa</label>
                                            <label for="tgl_periksa" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="date" name="tgl_periksa" class="form-control border-0 border-bottom ps-2" id="tgl_periksa" value="" required>
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
                                            <label for="berat_badan" class="col-sm-2 col-form-label" style="white-space: nowrap;">Berat Badan</label>
                                            <label for="berat_badan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9 d-flex align-items-center" style="margin-left: -50px;">
                                            <input type="number" name="berat_badan" class="form-control border-0 border-bottom ps-2" id="berat_badan" value="" required>
                                            <span style="margin-left: 15px;">kg</span>
                                        </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tinggi_badan" class="col-sm-2 col-form-label" style="white-space: nowrap;">Tinggi Badan</label>
                                            <label for="tiggi_badan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9 d-flex align-items-center" style="margin-left: -50px;">
                                            <input type="number" name="tinggi_badan" class="form-control border-0 border-bottom ps-2" id="tinggi_badan" value="" required>
                                            <span style="margin-left: 15px;">cm</span>
                                        </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                                            <label for="status" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                                <select name="status" id="status" class="form-select border-0 border-bottom" required>
                                                    <option value="" disabled selected>--Pilih Status Perkembangan--</option>
                                                    <option value="IDEAL">IDEAL</option>
                                                    <option value="TIDAK IDEAL">TIDAK IDEAL</option>
                                                    <option value="BELUM DIKETAHUI">BELUM DIKETAHUI</option>
                                                </select>
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