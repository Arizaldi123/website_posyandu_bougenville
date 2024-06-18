<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Perkembangan Balita - Posyandu Bougenville";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="added" role="alert">
    <i class="fa-solid fa-circle-check"></i> Tambah Data Perkembangan Balita berhasil..
  </div>';
}

if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-check"></i> Data Perkembangan Balita berhasil dihapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="updated" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data Perkembangan Balita berhasil diperbarui..
  </div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Perkembangan Balita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Perkembangan</li>
                        </ol>
                        <?php if ($msg != "") {
                            echo $alert;
                        } ?>
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-list"></i><span class="h5 my-2"> Data Perkembangan</span>
                                <a href="<?= $main_url ?>perkembangan/tambah-perkembangan.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Data</a>
                                <div class="dropdown" style="margin-top: -30px;">
                                    <button class="btn btn-sm btn-primary dropdown-toggle float-end me-2" type="button" data-bs-toggle="dropdown">Cetak</button>
                                    <ul class="dropdown-menu">
                                        <li><button type="button" onclick="printDoc()" class="dropdown-item">Laporan Perkembangan Balita (PDF)</button></li>
                                        <li><a href="../report/excel-perkembangan.php" class="dropdown-item">Laporan Perkembangan Balita (Excel)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                            <table class="table table-hover" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th scope="col"><center>No</center></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Petugas Periksa</th>
                                        <th scope="col">Tanggal Periksa</th>
                                        <th scope="col">Nama Balita</th>
                                        <th scope="col">Berat Badan</th>
                                        <th scope="col">Tinggi Badan</th>
                                        <th scope="col">Status Perkembangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $queryPerkembangan = mysqli_query($koneksi, "SELECT * FROM tbl_perkembangan");
                                        while ($data = mysqli_fetch_array($queryPerkembangan)){
                                            $tgl_periksa = date('d-m-Y', strtotime($data['tgl_periksa']));
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['id_perkembangan'] ?></td>
                                        <td><?= $data['petugas'] ?></td>
                                        <td><?= $tgl_periksa ?></td>
                                        <td><?= $data['nama_balita'] ?></td>
                                        <td><?= $data['berat_badan'] ?> kg</td>
                                        <td><?= $data['tinggi_badan'] ?> cm</td>
                                        <td>
                                            <?php 
                                                if ($data['status'] == 'IDEAL') { ?>
                                                    <button type="button" class="btn btn-success btn-sm rounded-0 col-15 fw-bold text-uppercase"><?= $data['status'] ?></button>
                                                    <?php } else if ($data['status'] == 'TIDAK IDEAL') { ?>
                                                        <button type="button" class="btn btn-danger btn-sm rounded-0 col-15 fw-bold text-uppercase"><?= $data['status'] ?></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-warning btn-sm rounded-0 col-15 fw-bold text-uppercase"><?= $data['status'] ?></button>
                                            <?php
                                                    }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="edit-perkembangan.php?id_perkembangan=<?= $data['id_perkembangan'] ?>" class="btn btn-sm btn-warning me-1" title="Update Perkembangan"><i class="fa-solid fa-pen"></i></a>
                                                <button type="button" class="btn btn-sm btn-danger" id="btnHapus" title="Hapus Perkembangan" data-id="<?= $data['id_perkembangan'] ?>"><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php     
                                        }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </main>

<!-- modal hapus data -->
<div class="modal" id="mdlHapus" tabindex="-1" data-bs-backrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="" id="btnMdlHapus" class="btn btn-primary">Ya</a>
      </div>
    </div>
  </div>
</div>

<script>
    function printDoc() {
        const myWindow = window.open("../report/laporan-perkembangan.php", "", "width=900, height=600, left=100");
    }

    $(document).ready(function() {
        $(document).on('click', "#btnHapus", function(){
            $('#mdlHapus').modal('show');
            let id = $(this).data('id');
            $('#btnMdlHapus').attr("href", "hapus-perkembangan.php?id_perkembangan=" + id);
        })

        setTimeout(function() {
            $('#added').fadeIn('slow');
        }, 300)
        setTimeout(function() {
            $('#added').fadeOut('slow');
        }, 3000)

        setTimeout(function() {
            $('#updated').slideDown(700);
        }, 300)
        setTimeout(function() {
            $('#updated').slideUp(700);
        }, 4000)
    })
</script>

<?php 

require_once "../template/footer.php";

?>