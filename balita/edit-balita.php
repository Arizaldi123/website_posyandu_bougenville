<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Update Balita - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$id_balita = $_GET['id_balita'];

$balita = mysqli_query($koneksi, "SELECT * FROM tbl_balita WHERE id_balita = '$id_balita'");
$data = mysqli_fetch_array($balita);

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Update Balita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="balita.php">Data Balita</a></li>
                            <li class="breadcrumb-item active">Update Balita</li>
                        </ol>
                        <form action="proses-balita.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Update Balita</span>
                                <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                                <a href="balita.php" class="btn btn-danger float-end me-2"><i class="fa-solid fa-xmark"></i> Cancel</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3 row">
                                            <label for="id_balita" class="col-sm-2 col-form-label">ID</label>
                                            <label for="id_balita" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="id_balita" class="form-control-plaintext border-bottom ps-2" id="id_balita" value="<?= $id_balita ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                            <label for="nik" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="nik" pattern="[0-9]{16,16}" title="minimal dan maksimal 16 angka" class="form-control border-0 border-bottom ps-2" id="nik" value="<?= $data['nik'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <label for="nama" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="text" name="nama" class="form-control border-0 border-bottom ps-2" id="nama" value="<?= $data['nama'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tgl_lahir" class="col-sm-2 col-form-label" style="white-space: nowrap;">Tanggal Lahir</label>
                                            <label for="tgl_lahir" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <input type="date" name="tgl_lahir" class="form-control border-0 border-bottom ps-2" id="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                                            <label for="umur" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9 d-flex align-items-center" style="margin-left: -50px;">
                                            <input type="number" name="umur" min="0" max="5" class="form-control border-0 border-bottom ps-2" id="umur" value="<?= $data['umur'] ?>" required>
                                            <span style="margin-left: 15px;">tahun</span>
                                        </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="jenis_kelamin" class="col-sm-2 col-form-label" style="white-space: nowrap;">Jenis Kelamin</label>
                                            <label for="jenis_kelamin" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select border-0 border-bottom" required>
                                                    <?php 
                                                        $jenis_kelamin = ["Laki-laki", "Perempuan"];
                                                        foreach ($jenis_kelamin as $jk) {
                                                            if ($data['jenis_kelamin'] == $jk) { ?>
                                                                <option value="<?= $jk; ?>" selected><?= $jk; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $jk; ?>"><?= $jk; ?></option>
                                                            <?php 
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="ibu" class="col-sm-2 col-form-label" style="white-space: nowrap;">Nama Ibu</label>
                                            <label for="ibu" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -50px;">
                                            <select name="ibu" id="ibu" class="form-select" required>
                                                <option value="" selected>--Pilih Nama Ibu--</option>
                                                <?php
                                                    $queryIbu = mysqli_query($koneksi, "SELECT * FROM tbl_ibu");
                                                    while ($dataIbu = mysqli_fetch_array($queryIbu)) {
                                                            if ($data['ibu'] == $dataIbu['nama']) {
                                                        ?>
                                                        <option value="<?= $dataIbu['nama'] ?>" selected><?= $dataIbu['nama'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $dataIbu['nama'] ?>"><?= $dataIbu['nama'] ?></option>
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