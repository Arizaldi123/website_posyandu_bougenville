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

$title = "Data Petugas - Posyandu Bougenville";
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
    <i class="fa-solid fa-circle-check"></i> Tambah Data Petugas berhasil..
  </div>';
}

if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="deleted" role="alert">
    <i class="fa-solid fa-check"></i> Data Petugas berhasil dihapus..
  </div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">
                    <div class="row align-items-center mb-4">
                        <div class="col">
                            <h1 class="mt-4">Data Petugas</h1>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                                <li class="breadcrumb-item active">Petugas</li>
                            </ol>
                        </div>
                        <div class="col-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-info-circle fa-2x text-primary"></i>
                                        <span class="ms-3">Informasikan kepada petugas bahwa password otomatis = 1234<br> Ganti password untuk keamanan akun!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php if ($msg != "") {
                            echo $alert;
                        } ?>
                        <div class="card">
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i><span class="h5 my-2"> Data Petugas</span>
                            <a href="<?= $main_url ?>petugas/tambah-petugas.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Data Petugas</a>
                            </div>
                            <div class="card-body">
                            <table class="table table-hover" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th scope="col"><center>No</center></th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Nama Petugas</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">No Telp</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $queryPetugas = mysqli_query($koneksi, "SELECT * FROM tbl_petugas");
                                        while ($data = mysqli_fetch_array($queryPetugas)){
                                            $levelText = '';
                                            if ($data['level'] == 1) {
                                                $levelText = 'Ketua Kader';
                                            } else if ($data['level'] == 2) {
                                                $levelText = 'Anggota Kader';
                                            }
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['nama_petugas'] ?></td>
                                        <td><?= $levelText ?></td>
                                        <td><?= $data['no_telp'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td align="center">
                                            <button type="button" class="btn btn-sm btn-danger" id="btnHapus" title="Hapus Petugas" data-id="<?= $data['id_petugas'] ?>"><i class="fa-solid fa-trash"></i></button>
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
    $(document).ready(function() {
        $(document).on('click', "#btnHapus", function(){
            $('#mdlHapus').modal('show');
            let id = $(this).data('id');
            $('#btnMdlHapus').attr("href", "hapus-petugas.php?id_petugas=" + id);
        })

        setTimeout(function() {
            $('#added').fadeIn('slow');
        }, 300)
        setTimeout(function() {
            $('#added').fadeOut('slow');
        }, 3000)

        setTimeout(function() {
            $('#deleted').slideDown(700);
        }, 300)
        setTimeout(function() {
            $('#deleted').slideUp(700);
        }, 4000)
    })
</script>

<?php 

require_once "../template/footer.php";

?>