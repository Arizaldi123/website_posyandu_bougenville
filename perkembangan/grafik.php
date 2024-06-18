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

$searchKeyword = '';
$chartData = [];

if (isset($_POST['search'])) {
    $searchKeyword = $_POST['searchKeyword'];
    $result = mysqli_query($koneksi, "SELECT tgl_periksa, tinggi_badan, berat_badan FROM tbl_perkembangan WHERE nama_balita = '$searchKeyword'");
    while ($row = mysqli_fetch_assoc($result)) {
        $chartData[] = $row;
    }
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Grafik Perkembangan Balita</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Grafik Perkembangan</li>
            </ol>

            <form method="POST" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari nama balita" name="searchKeyword" value="<?= htmlspecialchars($searchKeyword) ?>" required>
                    <button class="btn btn-primary" type="submit" name="search"><h6>Cari &nbsp;<i class="fa-solid fa-magnifying-glass"></i></h6></button>
                </div>
            </form>

            <?php if (empty($chartData) && $searchKeyword != ''): ?>
                <div class="alert alert-warning" role="alert">
                    Data yang anda cari tidak ditemukan, harap masukkan nama balita dengan benar!
                </div>
            <?php elseif (!empty($chartData)): ?>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Grafik Tinggi Badan Balita (Diagram Garis)
                            </div>
                            <div class="card-body">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Grafik Berat Badan Balita (Diagram Batang)
                            </div>
                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

<?php

require_once "../template/footer.php";

?>

<?php if (!empty($chartData)): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = <?= json_encode($chartData) ?>;
        
        const options = { month: 'long' };

        const labels = chartData.map(data => {
            const date = new Date(data.tgl_periksa);
            return date.toLocaleDateString('id-ID', options);
        });
        
        const tinggiBadan = chartData.map(data => data.tinggi_badan);
        const beratBadan = chartData.map(data => data.berat_badan);

        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tinggi Badan (cm)',
                    data: tinggiBadan,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan (Tahun <?= date('Y') ?>)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Tinggi Badan (cm)'
                        }
                    }
                }
            }
        });

        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: beratBadan,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan (Tahun <?= date('Y') ?>)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Berat Badan (kg)'
                        }
                    }
                }
            }
        });
    });
</script>
<?php endif; ?>
