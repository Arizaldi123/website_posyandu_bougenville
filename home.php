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
    <style class="text/css">
        .carousel-item img {
            max-height: 700px; /* Atur ketinggian maksimum sesuai kebutuhan Anda */
            object-fit: cover; /* Menjaga aspek rasio gambar */
            width: 100%;
        }
    </style>
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
                        <a href="home.php" class="nav-item nav-link active">Beranda</a>
                        <a href="about.php" class="nav-item nav-link">Tentang Posyandu</a>
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


    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="assets/img/slide-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-5 text-start">
                                    <p class="fs-4 text-white animated slideInRight">Selamat Datang di </p>
                                    <h5 class="display-1 text-white mb-5 animated slideInRight" style="background-color: rgba(0, 0, 0, 0.2); font-size:40px;"><?= $data['nama'] ?></h5>
                                    <a href="auth/login.php" class="btn btn-primary rounded-pill py-3 px-5 animated slideInRight">Login Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="assets/img/slide-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-5 text-end">
                                    <p class="fs-4 text-white animated slideInLeft">Selamat Datang di </p>
                                    <h5 class="display-1 text-white mb-5 animated slideInLeft" style="background-color: rgba(0, 0, 0, 0.2); font-size:40px;"><?= $data['nama'] ?></h5>
                                    <a href="auth/login.php" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Login Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Layanan</p>
                <h5 class="display-5 mb-5"><?= $data['nama'] ?></h5>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item position-relative h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 64px; height: 64px;">
                                <img class="img-fluid" src="assets/img/icon/icon-5.png" alt="Icon">
                            </div>
                            <h5 class="mb-3">Pendataan Petugas Posyandu</h4>
                                <p class="mb-0">Memudahkan proses pendataan petugas posyand yang mencakup informasi personal. Setiap petugas memiliki akses login yang aman untuk mengelola data.<br><br><br></p>
                        </div>
                        <div class="service-btn rounded-0 rounded-bottom">
                            <a class="text-primary fw-medium" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item position-relative h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 64px; height: 64px;">
                                <img class="img-fluid" src="assets/img/icon/icon-6.png" alt="Icon">
                            </div>
                            <h5 class="mb-3">Pendataan <br> Balita</h4>
                                <p class="mb-0">Pendataan balita menjadi lebih mudah dan cepat. Data yang dicatat mencakup informasi seperti nama, tanggal lahir, jenis kelamin, dan data ibu.<br><br><br><br></p>
                        </div>
                        <div class="service-btn rounded-0 rounded-bottom">
                            <a class="text-primary fw-medium" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item position-relative h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 64px; height: 64px;">
                                <img class="img-fluid" src="assets/img/icon/icon-7.png" alt="Icon">
                            </div>
                            <h5 class="mb-3">Pendataan <br> Ibu Balita</h4>
                                <p class="mb-0">Data ibu balita juga dicatat dan terdapat informasi kontak untuk memastikan ibu dan anak mendapatkan perhatian yang tepat.<br><br><br><br></p>
                        </div>
                        <div class="service-btn rounded-0 rounded-bottom">
                            <a class="text-primary fw-medium" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item position-relative h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 64px; height: 64px;">
                                <img class="img-fluid" src="assets/img/icon/icon-8.png" alt="Icon">
                            </div>
                            <h5 class="mb-3">Pendataan Imunisasi <br> Balita</h4>
                                <p class="mb-0">Pencatatan jadwal dan jenis imunisasi yang telah diterima balita. Petugas dapat dengan mudah memantau dan memastikan setiap balita mendapatkan imunisasi yang lengkap. <br><br><br></p>
                        </div>
                        <div class="service-btn rounded-0 rounded-bottom">
                            <a class="text-primary fw-medium" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item position-relative h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 64px; height: 64px;">
                                <img class="img-fluid" src="assets/img/icon/icon-9.png" alt="Icon">
                            </div>
                            <h5 class="mb-3">Pendataan Perkembangan Balita</h4>
                                <p class="mb-0">Perkembangan balita dapat dipantau melalui berbagai indikator kesehatan dan perkembangan, seperti berat badan dan tinggi badan. Data ini membantu dalam mengidentifikasi dan menangani potensi masalah perkembangan sejak dini.</p>
                        </div>
                        <div class="service-btn rounded-0 rounded-bottom">
                            <a class="text-primary fw-medium" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item position-relative h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                style="width: 64px; height: 64px;">
                                <img class="img-fluid" src="assets/img/icon/icon-10.png" alt="Icon">
                            </div>
                            <h5 class="mb-3">Laporan Perkembangan Balita</h4>
                                <p class="mb-0">Dapat mencetak laporan perkembangan balita secara keseluruhan untuk memudahkan petugas. Laporan ini berguna bagi orang tua dan tenaga kesehatan untuk memantau kesehatan dan perkembangan anak dengan lebih baik.</p>
                        </div>
                        <div class="service-btn rounded-0 rounded-bottom">
                            <a class="text-primary fw-medium" href="">Read More<i
                                    class="bi bi-chevron-double-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Quote Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-11 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-medium text-primary">Program Posyandu</p>
                    <h6 class="display-5 mb-4" style="font-size: 30px;">Apa sih program yang ada di posyandu?</h6>
                    <p style="text-align: justify;">Posyandu adalah kegiatan kesehatan dasar yang diselenggarakan dari, oleh dan untuk masyarakat yang dibantu oleh petugas kesehatan untuk memberdayakan dan memberikan kemudahan kepada masyarakat guna memperoleh pelayanan kesehatan bagi ibu, bayi dan anak balita. Posyandu yang sudah ada dimasyarakat saat ini sangat berperan dalam mendukung pencapaian pembangunan kesehatan ibu dan anak.</p>
                    <p class="mb-4" style="text-align: justify;">Dengan program Posyandu Balita di Desa Sambirejo selama ini berjalan dengan baik dan rutin dilakukan satu kali dalam satu bulan dan pembinaan yang dilakukan oleh Puskesmas secara bergantian di masing-masing Posyandu yang sudah tersebar di masing-masing desa di Kabupaten Jombang sangat membantu masyarakat utamanya kesehatan ibu dan anak.. Ada lima program prioritas yang dilakukan oleh Posyandu yaitu : <strong> KB, KIA, gizi, imunisasi, dan penanggulangan diare </strong>. Dengan program tersebut terbukti dapat menurunkan angka kematian bayi dan balita. Partisipasi masyarakat dalam mendukung terlaksananya Posyandu Balita ini sangat penting, tanpa keikutsertaan mereka ke Posyandu maka program ini tidak akan dapat berjalan dengan baik. Dengan keaktifan mereka untuk datang dan memanfaatkan pelayanan kesehatan di posyandu dapat mencegah dan mendeteksi sedini mungkin gangguan dan hambatan pertumbuhan pada balita.</p>
                    <a class="d-inline-flex align-items-center rounded overflow-hidden border border-primary" href="">
                        <span class="btn-lg-square bg-primary" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </span>
                        <span class="fs-5 fw-medium mx-4"><?= $data['no_telp'] ?></span>
                    </a>
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