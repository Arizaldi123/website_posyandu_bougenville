<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Data Balita - Posyandu Bougenville";
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
    <i class="fa-solid fa-circle-check"></i> Tambah Data Balita berhasil..
  </div>';
}

if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-check"></i> Data berhasil dihapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="updated" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data Balita berhasil diperbarui..
  </div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Balita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Balita</li>
                        </ol>
                        <?php if ($msg != "") {
                            echo $alert;
                        } ?>
                        <div class="card">
                            <div class="card-header">
                                <i class="fa-solid fa-list"></i><span class="h5 my-2"> Data Balita</span>
                                <a href="<?= $main_url ?>balita/tambah-balita.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col"><center>ID</center></th>
                                            <th scope="col"><center>NIK</center></th>
                                            <th scope="col"><center>Nama Balita</center></th>
                                            <th scope="col"><center>Tgl Lahir</center></th>
                                            <th scope="col"><center>Umur</center></th>
                                            <th scope="col"><center>Jenis Kelamin</center></th>
                                            <th scope="col"><center>Nama Ibu</center></th>
                                            <th scope="col"><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $queryPetugas = mysqli_query($koneksi, "SELECT * FROM tbl_balita");
                                            while ($data = mysqli_fetch_array($queryPetugas)) { 
                                                $tgl_lahir = date('d-m-Y', strtotime($data['tgl_lahir']));
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?=  $data['id_balita'] ?></td>
                                            <td><?=  $data['nik'] ?></td>
                                            <td><?=  $data['nama'] ?></td>
                                            <td><?=  $tgl_lahir ?></td>
                                            <td><?=  $data['umur'] ?> tahun</td>
                                            <td><?=  $data['jenis_kelamin'] ?></td>
                                            <td><?=  $data['ibu'] ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="edit-balita.php?id_balita=<?= $data['id_balita'] ?>" class="btn btn-sm btn-warning me-1" title="Update Balita"><i class="fa-solid fa-pen"></i></a>
                                                    <button type="button" class="btn btn-sm btn-danger" id="btnHapus" title="Hapus Balita" data-id="<?= $data['id_balita'] ?>"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
            $('#btnMdlHapus').attr("href", "hapus-balita.php?id_balita=" + id);
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