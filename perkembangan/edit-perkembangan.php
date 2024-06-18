<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Data Perkembangan - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id = $_GET['id_perkembangan'];

$queryPerkembangan = mysqli_query($koneksi, "SELECT * FROM tbl_perkembangan WHERE id_perkembangan = '$id'");
$data = mysqli_fetch_array($queryPerkembangan);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Update Data Perkembangan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="perkembangan.php">Data Perkembangan</a></li>
                            <li class="breadcrumb-item active">Update Data Perkembangan</li>
                        </ol>
                        <form action="proses-perkembangan.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <i class=""></i><span class="h5 my-2"> Update Data Perkembangan</span>
                                <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                                <a href="perkembangan.php" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Cancel</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3 row">
                                            <label for="id_perkembangan" class="col-sm-2 col-form-label">ID</label>
                                            <label for="id_perkembangan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="id_perkembangan" class="form-control-plaintext border-bottom ps-2" id="id_perkembangan" value="<?= $data['id_perkembangan'] ?>" readonly>
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
                                                    while ($dataPetugas = mysqli_fetch_array($queryPetugas)) {
                                                            if ($data['petugas'] == $dataPetugas['nama_petugas']) {
                                                        ?>
                                                        <option value="<?= $dataPetugas['nama_petugas'] ?>" selected><?= $dataPetugas['nama_petugas'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $dataPetugas['nama_petugas'] ?>"><?= $dataPetugas['nama_petugas'] ?></option>
                                                <?php 
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tgl_periksa" class="col-sm-2 col-form-label" style="white-space: nowrap;">Tanggal Periksa</label>
                                            <label for="tgl_periksa" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="date" name="tgl_periksa" class="form-control border-0 border-bottom ps-2" id="tgl_periksa" value="<?= $data['tgl_periksa'] ?>" required>
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
                                                    while ($dataBalita = mysqli_fetch_array($queryBalita)) {
                                                            if ($data['nama_balita'] == $dataBalita['nama']) {
                                                        ?>
                                                        <option value="<?= $dataBalita['nama'] ?>" selected><?= $dataBalita['nama'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $dataBalita['nama'] ?>"><?= $dataBalita['nama'] ?></option>
                                                <?php 
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="berat_badan" class="col-sm-2 col-form-label" style="white-space: nowrap;">Berat Badan</label>
                                            <label for="berat_badan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9 d-flex align-items-center" style="margin-left: -50px;">
                                            <input type="number" step="any" min="1" name="berat_badan" class="form-control border-0 border-bottom ps-2" id="berat_badan" value="<?= $data['berat_badan'] ?>" required>
                                            <span style="margin-left: 15px;">kg</span>
                                        </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tinggi_badan" class="col-sm-2 col-form-label" style="white-space: nowrap;">Tinggi Badan</label>
                                            <label for="tinggi_badan" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9 d-flex align-items-center" style="margin-left: -50px;">
                                            <input type="number" step="any" min="1" name="tinggi_badan" class="form-control border-0 border-bottom ps-2" id="tinggi_badan" value="<?= $data['tinggi_badan'] ?>" required>
                                            <span style="margin-left: 15px;">cm</span>
                                        </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                                            <label for="status" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                                <select name="status" id="status" class="form-select border-0 border-bottom" required>
                                                <?php 
                                                        $status = ["IDEAL", "TIDAK IDEAL", "BELUM DIKETAHUI"];
                                                        foreach ($status as $st) {
                                                            if ($data['status'] == $st) { ?>
                                                                <option value="<?= $st; ?>" selected><?= $st; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $st; ?>"><?= $st; ?></option>
                                                            <?php 
                                                            }
                                                        }
                                                    ?>
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