<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Perkembangan Balita</title>
    <link href="<?= $main_url ?>asset/sb-admin/css/styles.css" rel="stylesheet" />
    <style>
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .details {
            text-align: center;
        }
        .header .details h4,
        .header .details p {
            margin: 0;
        }
        .date {
            text-align: right;
            margin-top: -20px;
        }
        .title {
            text-align: center;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Agar garis antar sel tidak terlalu tebal */
        }
        th, td {
            text-align: center; /* Memusatkan teks di dalam sel */
            vertical-align: middle; /* Memusatkan vertikal konten di dalam sel */
            padding: 8px; /* Padding di dalam sel */
        }
        .badge {
            padding: 5px 10px; /* Padding untuk badge */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="details">
                <h4>Posyandu Bougenville</h4>
                <p class="my-2">Alamat : Dusun Sawahan Desa Sambirejo Kecamatan Jogoroto Kabupaten Jombang</p>
                <h6>____________________________________________________________________________________________________</h6>
                <h6>____________________________________________________________________________________________________</h6>
            </div>
        </div>
            <div class="date">
            <?php
                date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke WIB

                // Daftar nama bulan dalam Bahasa Indonesia
                $bulan = array(
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                );

                // Mendapatkan tanggal saat ini dalam format Bahasa Indonesia
                $tanggal_sekarang = strftime('%e', strtotime('now')) . ' ' . $bulan[date('n') - 1] . ' ' . date('Y');
                $waktu_sekarang = date('H:i');
            ?>

                <p>Jombang, <?= $tanggal_sekarang ?></p>
                <p>Pukul <?= $waktu_sekarang ?></p>
            </div>

        <div class="title">
            <h5>Data Perkembangan Balita</h5>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama Balita</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Berat Badan</th>
                    <th scope="col">Tinggi Badan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    $query = "
                        SELECT 
                            p.id_perkembangan, 
                            b.nama AS nama_balita, 
                            b.nik,
                            b.jenis_kelamin,
                            b.umur,
                            p.tgl_periksa, 
                            p.berat_badan, 
                            p.tinggi_badan, 
                            p.status 
                        FROM 
                            tbl_perkembangan p 
                        LEFT JOIN 
                            tbl_balita b ON p.nama_balita = b.nama
                    ";
                    $result = mysqli_query($koneksi, $query);
                    while ($data = mysqli_fetch_array($result)){
                        $tgl_periksa = date('d-m-Y', strtotime($data['tgl_periksa']));
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $data['id_perkembangan'] ?></td>
                    <td><?= $data['nik'] ?></td>
                    <td><?= $data['nama_balita'] ?></td>
                    <td><?= $data['jenis_kelamin'] ?></td>
                    <td><?= $data['umur'] ?> tahun</td>
                    <td><?= $tgl_periksa ?></td>
                    <td><?= $data['berat_badan'] ?> kg</td>
                    <td><?= $data['tinggi_badan'] ?> cm</td>
                    <td>
                        <?php 
                            if ($data['status'] == 'IDEAL') { ?>
                            <h6 style="color: green; font-weight: bold;"> <?= $data['status'] ?></h6>
                            <?php } else if ($data['status'] == 'TIDAK IDEAL') { ?>
                                <h6 style="color: red; font-weight: bold;"><?= $data['status'] ?></h6>
                                <?php } else { ?>
                                <h6 style="color: yellow; font-weight: bold;"><?= $data['status'] ?></h6>
                        <?php } ?>
                    </td>
                </tr>
                <?php     
                    }
                ?>
            </tbody>
        </table>  
    </div>
    
    <script type="text/javascript">
        window.print();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= $main_url ?>asset/sb-admin/js/scripts.js"></script>
</body>
</html>
