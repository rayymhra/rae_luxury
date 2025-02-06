<?php
use Core\Database;
include '../../config/database.php';
include '../../templates/sidebar.php';

$db = Database::getInstance()->getConnection();

// Get total users (Petugas & User)
$total_users = $db->query("SELECT COUNT(*) AS total FROM admin")->fetch_assoc()['total'];
$total_petugas = $db->query("SELECT COUNT(*) AS total FROM petugas")->fetch_assoc()['total'];
$total_user = $db->query("SELECT COUNT(*) AS total FROM user")->fetch_assoc()['total'];

// Get total barang
$total_barang = $db->query("SELECT COUNT(*) AS total FROM barang")->fetch_assoc()['total'];

// Get total peminjaman
$total_peminjaman = $db->query("SELECT COUNT(*) AS total FROM peminjaman")->fetch_assoc()['total'];

// Get total pengembalian
$total_pengembalian = $db->query("SELECT COUNT(*) AS total FROM peminjaman WHERE status='Dikembalikan'")->fetch_assoc()['total'];

// Fetch data for ChartJS (peminjaman per month)
$peminjaman_chart = $db->query("SELECT DATE_FORMAT(tanggal_pinjam, '%Y-%m') AS bulan, COUNT(*) AS total FROM peminjaman GROUP BY bulan ORDER BY bulan ASC");
$bulan = [];
$total_peminjaman_per_bulan = [];
while ($row = $peminjaman_chart->fetch_assoc()) {
    $bulan[] = $row['bulan'];
    $total_peminjaman_per_bulan[] = $row['total'];
}
?>


<div class="container mt-4">
    <h2>Dashboard Admin</h2>

    <div class="row">
        <div class="col-10">
            <div class="row">
        <!-- Users Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="card-text"><?= $total_user ?></p>
                </div>
            </div>
        </div>

        <!-- Barang Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text"><?= $total_barang ?></p>
                </div>
            </div>
        </div>

        <!-- Peminjaman Card -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Peminjaman</h5>
                    <p class="card-text"><?= $total_peminjaman ?></p>
                </div>
            </div>
        </div>

        <!-- Pengembalian Card -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pengembalian</h5>
                    <p class="card-text"><?= $total_pengembalian ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Statistik Peminjaman per Bulan</h5>
            <canvas id="peminjamanChart"></canvas>
        </div>
    </div>
        </div>
        <div class="col-2">
            kalender
        </div>
    </div>
    
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('peminjamanChart').getContext('2d');
    var peminjamanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($bulan) ?>,
            datasets: [{
                label: 'Peminjaman',
                data: <?= json_encode($total_peminjaman_per_bulan) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include '../../templates/footer.php'; ?>
