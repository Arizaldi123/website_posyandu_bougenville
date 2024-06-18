<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-5" href="<?= $main_url ?>index.php">Posyandu Bougenville</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="margin-left: -210px; padding-top: 5px;" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
                <span class="text-white text-capitalize"><?= $_SESSION["ssPetugas"] ?></span>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" data-bs-toggle="modal" href="#mdlProfilePetugas">Profile Kader Posyandu</a></li>
                        <li><a class="dropdown-item" href="<?= $main_url ?>posyandu/profile-posyandu.php">Profile Posyandu</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?= $main_url ?>auth/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

<?php 

$username = $_SESSION["ssPetugas"];
$queryPetugas = mysqli_query($koneksi, "SELECT * FROM tbl_petugas WHERE username = '$username'");
$profile = mysqli_fetch_array($queryPetugas);

$levelText = '';
if ($profile['level'] == 1) {
    $levelText = 'Ketua Kader';
} else if ($profile['level'] == 2) {
    $levelText = 'Anggota Kader';
}

?>

<div class="modal" tabindex="-1" id="mdlProfilePetugas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profile Kader</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card mb-3 border-0" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-3">
            <img src="<?= $main_url ?>assets/img/profile.png" class="img-fluid rounded-start" alt="profil">
            </div>
            <div class="col-md-9">
            <div class="card-body">
            <h4 class="card-title mb-3 text-capitalize ps-1"><?= $profile['username'] ?></h4>
            <hr>
            <div class="row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                <input type="text" class="form-control border-0 bg-transparent" id="nama" value=": <?= $profile['nama_petugas'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <label for="jabatan" class="col-sm-3 col-form-label pe-0">Jabatan</label>
                <div class="col-sm-9">
                <input type="text" class="form-control border-0 bg-transparent" id="level" value=": <?= $levelText ?>" readonly>
                </div>
            </div>
            <div class="row">
                <label for="notelp" class="col-sm-3 col-form-label pe-0">No. Telp</label>
                <div class="col-sm-9">
                <input type="text" class="form-control border-0 bg-transparent" id="notelp" value=": <?= $profile['no_telp'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <label for="alamat" class="col-sm-3 col-form-label pe-0">Alamat</label>
                <div class="col-sm-9">
                <textarea id="alamat" cols="30" rows="2" class="form-control border-0 bg-transparent" readonly>: <?= $profile['alamat'] ?></textarea>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
      </div>
    </div>
  </div>
</div>