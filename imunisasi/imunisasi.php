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
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="added" role="alert">
    <i class="fa-solid fa-circle-check"></i> Tambah Data Imunisasi berhasil..
  </div>';
}

if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-check"></i> Data Imunisasi berhasil dihapus.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="updated" role="alert">
    <i class="fa-solid fa-circle-check"></i> Data Imunisasi berhasil diperbarui..
  </div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Imunisasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Imunisasi</li>
                        </ol>
                        <?php if ($msg != "") {
                            echo $alert;
                        } ?>
                        <div class="card">
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i><span class="h5 my-2"> Data Imunisasi</span>
                            <a href="<?= $main_url ?>imunisasi/tambah-imunisasi.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Data</a>
                            <div class="dropdown" style="margin-top: -30px;">
                                    <button class="btn btn-sm btn-primary dropdown-toggle float-end me-2" type="button" data-bs-toggle="dropdown">Cetak</button>
                                    <ul class="dropdown-menu">
                                        <li><button type="button" onclick="printDoc()" class="dropdown-item">Laporan Imunisasi Balita (PDF)</button></li>
                                        <li><a href="../report/excel-imunisasi.php" class="dropdown-item">Laporan Imunisasi Balita (Excel)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                            <table class="table table-hover" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th scope="col"><center>No</center></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tanggal Imunisasi</th>
                                        <th scope="col">Nama Balita</th>
                                        <th scope="col">Imunisasi</th>
                                        <th scope="col">Pemberian Vitamin</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $queryImunisasi = mysqli_query($koneksi, "SELECT * FROM tbl_imunisasi");
                                        while ($data = mysqli_fetch_array($queryImunisasi)){
                                            $tgl_imunisasi = date('d-m-Y', strtotime($data['tgl_imunisasi']));
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['id_imunisasi'] ?></td>
                                        <td><?= $tgl_imunisasi ?></td>
                                        <td><?= $data['nama_balita'] ?></td>
                                        <td><?= $data['imunisasi'] ?></td>
                                        <td><?= $data['vitamin'] ?></td>
                                        <td align="center">
                                            <a href="edit-imunisasi.php?id_imunisasi=<?= $data['id_imunisasi'] ?>" class="btn btn-sm btn-warning" title="Update Imunisasi"><i class="fa-solid fa-pen"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" id="btnHapus" title="Hapus Imunisasi" data-id="<?= $data['id_imunisasi'] ?>"><i class="fa-solid fa-trash"></i></button>
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
        const myWindow = window.open("../report/laporan-imunisasi.php", "", "width=900, height=600, left=100");
    }

    $(document).ready(function() {
        $(document).on('click', "#btnHapus", function(){
            $('#mdlHapus').modal('show');
            let id = $(this).data('id');
            $('#btnMdlHapus').attr("href", "hapus-imunisasi.php?id_imunisasi=" + id);
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