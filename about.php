<?php

require_once 'config.php';

$posyandu = mysqli_query($koneksi,"SELECT * FROM tbl_posyandu WHERE id = 1");
$data = mysqli_fetch_array($posyandu);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Posyandu Bougenville</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
 <!-- Spinner Start -->
 <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-primary text-white d-none d-lg-flex">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <a href="home.php">
                    <h2 class="text-white fw-bold m-0"><?= $data['nama'] ?></h2>
                </a>
                <div class="ms-auto d-flex align-items-center">
                    <small class="ms-4"><i class="fa fa-map-marker-alt me-3"></i><?= $data['alamat'] ?></small>
                    <small class="ms-4"><i class="fa fa-envelope me-3"></i><?= $data['email'] ?></small>
                    <small class="ms-4"><i class="fa fa-phone-alt me-3"></i><?= $data['no_telp'] ?></small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
                <a href="home.php" class="navbar-brand d-lg-none">
                    <h1 class="fw-bold m-0"><?= $data['nama'] ?></h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="home.php" class="nav-item nav-link">Beranda</a>
                        <a href="about.php" class="nav-item nav-link active">Tentang Posyandu</a>
                        <a href="contact.php" class="nav-item nav-link">Kontak</a>
                    </div>
                    <div class="ms-auto d-none d-lg-block">
                        <a href="auth/login.php" class="btn btn-primary rounded-pill py-2 px-3">Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-black mb-4 animated slideInDown" style="font-size: 50px;">Tentang Posyandu</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item text-primary" aria-current="page">Tentang Posyandu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

     <!-- Quote Start -->
     <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-11 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-medium text-primary">Program Posyandu</p>
                    <h6 class="display-5 mb-4" style="font-size: 30px;">Apa sih program yang ada di posyandu?</h6>
                    <p style="text-align: justify;">Posyandu adalah kegiatan kesehatan dasar yang diselenggarakan dari, oleh dan untuk masyarakat yang dibantu oleh petugas kesehatan untuk memberdayakan dan memberikan kemudahan kepada masyarakat guna memperoleh pelayanan kesehatan bagi ibu, bayi dan anak balita. Posyandu yang sudah ada dimasyarakat saat ini sangat berperan dalam mendukung pencapaian pembangunan kesehatan ibu dan anak.</p>
                    <p class="mb-4" style="text-align: justify;">Dengan program Posyandu Balita di Desa Sambirejo selama ini berjalan dengan baik dan rutin dilakukan satu kali dalam satu bulan dan pembinaan yang dilakukan oleh Puskesmas secara bergantian di masing-masing Posyandu yang sudah tersebar di masing-masing desa di Kabupaten Jombang sangat membantu masyarakat utamanya kesehatan ibu dan anak.. Ada lima program prioritas yang dilakukan oleh Posyandu yaitu : <strong> KB, KIA, gizi, imunisasi, dan penanggulangan diare </strong>. Dengan program tersebut terbukti dapat menurunkan angka kematian bayi dan balita. Partisipasi masyarakat dalam mendukung terlaksananya Posyandu Balita ini sangat penting, tanpa keikutsertaan mereka ke Posyandu maka program ini tidak akan dapat berjalan dengan baik. Dengan keaktifan mereka untuk datang dan memanfaatkan pelayanan kesehatan di posyandu dapat mencegah dan mendeteksi sedini mungkin gangguan dan hambatan pertumbuhan pada balita.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote Start -->

<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Our Posyandu</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= $data['alamat'] ?></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $data['no_telp'] ?></p>
                    <p class="mb-2" style="white-space: nowrap;"><i class="fa fa-envelope me-3"></i><?= $data['email'] ?></p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="about.php">Tentang Posyandu</a>
                    <a class="btn btn-link" href="contact.php">Kontak</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Jam Kerja Posyandu</h4>
                    <p class="mb-1">Sabtu - Minggu</p>
                    <h6 class="text-light">07:00 WIB - 12:00 WIB</h6>
                    <p class="mb-1">Senin - Jum'at</p>
                    <h6 class="text-light">Tentative</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-medium text-light" href="home.php">Kelompok 13 Pemrograman Website</a> <?= date("Y") ?>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>