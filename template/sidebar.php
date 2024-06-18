<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure the user is logged in
if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

// Ensure the user's level is available
if (!isset($_SESSION["ssLevel"])) {
    // You may want to handle this case (e.g., log out the user, show an error, etc.)
    header("location:../auth/login.php");
    exit;
}
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link" href="<?= $main_url ?>index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Petugas</div>
                    <?php if ($_SESSION["ssLevel"] == 1): ?>
                    <a class="nav-link" href="<?= $main_url ?>petugas/petugas.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Petugas
                    </a>
                    <?php endif; ?>
                    <a class="nav-link" href="<?= $main_url ?>petugas/ganti-password.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                        Ganti Password
                    </a>
                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Data</div>
                    <a class="nav-link" href="<?= $main_url ?>balita/balita.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Balita
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>ibu/ibu.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        Ibu
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>jenis_imunisasi/jenis-imunisasi.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-syringe"></i></div>
                        Jenis Imunisasi
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>imunisasi/imunisasi.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-child"></i></div>
                        Imunisasi Balita
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>perkembangan/perkembangan.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-children"></i></div>
                        Perkembangan Balita
                    </a>
                    <a class="nav-link" href="<?= $main_url ?>perkembangan/grafik.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                        Grafik Perkembangan
                    </a>
                    <hr class="mb-0">
                </div>
            </div>
            <div class="sb-sidenav-footer border">
                <div class="small">Logged in as:</div>
                <?= $_SESSION["ssPetugas"] ?>
            </div>
        </nav>
    </div>
