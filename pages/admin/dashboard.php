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


<div class="container dashboard-container">
    <div class="row">
        <div class="col-md-9">
            <div class="welcome-banner">
                <h2>Welcome,</h2>
                <p>The ultimate dashboard for your analytics</p>
                <!-- <div class="d-flex align-items-center">
                    <img src="your-image.png" alt="Welcome Image" style="width: 100px; margin-right: 20px;">
                    <div>
                        <h3>Hi bruh,</h3>
                        <p>Welcome back admin >.<</p>
                    </div>
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-dashboard text-center">
                        <div class="card-body">
                            <h5>Total <br>Pengguna</h5>
                            <p><?= $total_user ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-dashboard text-center">
                        <div class="card-body">
                            <h5>Total <br>Barang</h5>
                            <p><?= $total_barang ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-dashboard text-center">
                        <div class="card-body">
                            <h5>Total Peminjaman</h5>
                            <p><?= $total_peminjaman ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-dashboard text-center">
                        <div class="card-body">
                            <h5>Total Pengembalian</h5>
                            <p><?= $total_pengembalian ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Statistik Peminjaman per Bulan</h5>
                    <canvas id="peminjamanChart"></canvas>
                </div>
            </div>

            <div class="timing-progress">
                <h3>Timing & Progress</h3>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%;"></div>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 30%;"></div>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 90%;"></div>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%;"></div>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 20%;"></div>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 10%;"></div>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 60%;"></div>
                </div>

                <div class="d-flex justify-content-around">
                    <span>Mon</span>
                    <span>Tue</span>
                    <span>Wed</span>
                    <span>Thu</span>
                    <span>Fri</span>
                    <span>Sat</span>
                    <span>Sun</span>
                </div>
            </div>

            
        </div>

        <div class="col-md-3">
    <div class="calendar-container">
        <?php
        $currentMonth = date('F'); // Full month name (e.g., January)
        $currentYear = date('Y'); // 4-digit year (e.g., 2024)
        $currentDay = date('j'); // Day of the month (1-31)

        $firstDayOfMonth = date('w', strtotime("{$currentYear}-{$currentMonth}-01")); // Day of the week (0-6)
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('n'), $currentYear); // Number of days in the month
        ?>

        <h3><?php echo strtoupper($currentMonth); ?></h3>

        <div class="calendar-grid">
            <div class="calendar-day">Mon</div>
            <div class="calendar-day">Tue</div>
            <div class="calendar-day">Wed</div>
            <div class="calendar-day">Thu</div>
            <div class="calendar-day">Fri</div>
            <div class="calendar-day">Sat</div>
            <div class="calendar-day">Sun</div>

            <?php
            $dayCount = 1;
            $days = [];

            // Add empty cells for days before the 1st
            for ($i = 0; $i < $firstDayOfMonth; $i++) {
                $days[] = null;
            }

            // Add days of the month
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $days[] = $i;
            }

            foreach ($days as $day) {
                if ($day === null) {
                    echo '<div class="calendar-day">&nbsp;</div>';
                } else {
                    $isCurrent = ($day == $currentDay);
                    echo '<div class="calendar-day' . ($isCurrent ? ' current' : '') . '">' . $day . '</div>';
                }
            }
            ?>
        </div>

        <div class="calendar-legend">
            <div class="legend-item"><span class="current-day"></span> Current day</div>
        </div>
    </div>
</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
                backgroundColor: '#531111',
                /* Calendar color for chart */
                borderColor: '#CFBFA6',
                /* Card color for chart border */
                borderWidth: 1,
                borderRadius: 10, // Rounded corners for bars
                borderSkipped: false, // Apply borderRadius to all sides of the bar
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#444'
                    },
                    ticks: {
                        color: '#000' /* Dark text for contrast */
                    }
                },
                x: {
                    grid: {
                        color: '#444'
                    },
                    ticks: {
                        color: '#000' /* Dark text for contrast */
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#000' /* Dark text for contrast */
                    }
                }
            }
        }
    });
</script>

<?php include '../../templates/footer.php'; ?>