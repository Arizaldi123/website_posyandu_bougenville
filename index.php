<?php 
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: auth/login.php");
    exit;
}

require_once "config.php";

$title = "Dashboard - Posyandu Bougenville";

require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";

// Filtering data by month and year
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

$queryBalita = mysqli_query($koneksi, "SELECT * FROM tbl_balita");
$jmlBalita = mysqli_num_rows($queryBalita);

$queryPetugas = mysqli_query($koneksi, "SELECT * FROM tbl_petugas");
$jmlPetugas = mysqli_num_rows($queryPetugas);

$PerkembanganIdeal = mysqli_query($koneksi, "SELECT * FROM tbl_perkembangan WHERE status = 'IDEAL' AND MONTH(tgl_periksa) = $month AND YEAR(tgl_periksa) = $year");
$jmlPerkembanganIdeal = mysqli_num_rows($PerkembanganIdeal);

$PerkembanganTidakIdeal = mysqli_query($koneksi, "SELECT * FROM tbl_perkembangan WHERE status = 'TIDAK IDEAL' AND MONTH(tgl_periksa) = $month AND YEAR(tgl_periksa) = $year");
$jmlPerkembanganTidakIdeal = mysqli_num_rows($PerkembanganTidakIdeal);

$PerkembanganBelumDiketahui = mysqli_query($koneksi, "SELECT * FROM tbl_perkembangan WHERE status = 'BELUM DIKETAHUI' AND MONTH(tgl_periksa) = $month AND YEAR(tgl_periksa) = $year");
$jmlPerkembanganBelumDiketahui = mysqli_num_rows($PerkembanganBelumDiketahui);

// Query untuk mendapatkan jumlah perkembangan balita per nama balita
$queryNamaBalita = mysqli_query($koneksi, "SELECT nama_balita, COUNT(*) AS total_perkembangan FROM tbl_perkembangan GROUP BY nama_balita");
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($queryNamaBalita)) {
    $labels[] = $row['nama_balita'];
    $data[] = $row['total_perkembangan'];
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            
            <div class="row">
                <div class="col-md-12 mb-2">
                    <form method="GET" action="index.php" class="d-flex justify-content-end">
                        <div class="row align-items-center">
                            <div class="col-md-4 mb-3">
                                <select name="month" class="form-control form-control-sm">
                                    <option value="" disabled>Pilih Bulan</option>
                                    <?php 
                                        $monthNames = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                        ];
                                        foreach($monthNames as $key => $value) {
                                            $selected = ($key == $month) ? 'selected' : '';
                                            echo "<option value='$key' $selected>$value</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <select name="year" class="form-control form-control-sm">
                                    <option value="" disabled>Pilih Tahun</option>
                                    <?php 
                                        $currentYear = date('Y');
                                        for($y=$currentYear; $y>=2000; $y--) {
                                            $selected = ($y == $year) ? 'selected' : '';
                                            echo "<option value='$y' $selected>$y</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3 ms-auto">
                                <button type="submit" class="btn btn-primary btn-sm">Filter Status <i class="fa-solid fa-filter"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Jumlah Seluruh Balita</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#"><?= $jmlBalita . ' Orang' ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Jumlah Seluruh Petugas</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#"><?= $jmlPetugas . ' Orang' ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Jumlah Status Balita Ideal</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#"><?= $jmlPerkembanganIdeal . ' Balita' ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body" style="font-size: 15px;" >Jumlah Status Balita Tidak Ideal</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#"><?= $jmlPerkembanganTidakIdeal . ' Balita' ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Diagram Nama Balita Aktif Cek Perkembangan
                        </div>
                        <div class="card-body">
                            <canvas id="namaBalitaBarChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie me-1"></i>
                            Diagram Status Perkembangan Balita
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-justify" style="position: relative; height:280px;"><canvas id="perkembanganPieChart"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctxBar = document.getElementById('namaBalitaBarChart').getContext('2d');
        var dataBar = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Jumlah Cek Perkembangan',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        };

        var optionsBar = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Nama Balita'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Perkembangan'
                    }
                }
            }
        };

        var namaBalitaBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: dataBar,
            options: optionsBar
        });
    });
    </script>

    <script>
        var ctx = document.getElementById('perkembanganPieChart').getContext('2d');
        var perkembanganPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Ideal', 'Tidak Ideal', 'Belum Diketahui'],
                datasets: [{
                    data: [
                        <?= $jmlPerkembanganIdeal ?>,
                        <?= $jmlPerkembanganTidakIdeal ?>,
                        <?= $jmlPerkembanganBelumDiketahui ?>
                    ],
                    backgroundColor: ['#28a745', '#dc3545', '#e67e22'],
                    hoverBackgroundColor: ['#218838', '#c82333', '#e07b00'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                var total = <?= $jmlPerkembanganIdeal + $jmlPerkembanganTidakIdeal + $jmlPerkembanganBelumDiketahui ?>;
                                var percentage = (context.raw / total * 100).toFixed(0) + '%';
                                label += percentage;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>

<?php 
require_once "template/footer.php";
?>
