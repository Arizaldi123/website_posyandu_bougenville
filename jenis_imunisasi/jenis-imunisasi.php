<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Jenis Imunisasi - Posyandu Bougenville";
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
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Tambah Jenis Imunisasi berhasil..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-check"></i> Jenis Imunisasi berhasil dihapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check"></i> Jenis Imunisasi berhasil diperbarui..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Jenis Imunisasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Imunisasi</li>
                        </ol>
                        <?php if ($msg != "") {
                            echo $alert;
                        } ?>
                        <div class="card">
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i><span class="h5 my-2"> Jenis Imunisasi</span>
                            <a href="<?= $main_url ?>jenis_imunisasi/tambah-jenis.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah</a>
                            </div>
                            <div class="card-body">
                            <table class="table table-hover" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th scope="col"><center>No</center></th>
                                        <th scope="col">Nama Imunisasi</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $queryJenis = mysqli_query($koneksi, "SELECT * FROM tbl_jenis_imunisasi");
                                        while ($data = mysqli_fetch_array($queryJenis)){
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['imunisasi'] ?></td>
                                        <td><?= $data['keterangan'] ?></td>
                                        <td align="center">
                                            <a href="edit-jenis.php?id_jenis=<?= $data['id_jenis'] ?>" class="btn btn-sm btn-warning" title="Update Jenis Imunisasi"><i class="fa-solid fa-pen"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" id="btnHapus" title="Hapus Jenis Imunisasi" data-id="<?= $data['id_jenis'] ?>"><i class="fa-solid fa-trash"></i></button>
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
    $(document).ready(function(){
        $(document).on('click', "#btnHapus", function(){
            $('#mdlHapus').modal('show');
            let idJenis = $(this).data('id');
            $('#btnMdlHapus').attr("href", "hapus-jenis.php?id_jenis=" + idJenis);
        })
    })
</script>

<?php 

require_once "../template/footer.php";

?>