<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$totalKaryawan = $pdo->query(
    "SELECT COUNT(*) FROM karyawan"
)->fetchColumn();

$totalDivisi = $pdo->query(
    "SELECT COUNT(*) FROM divisi"
)->fetchColumn();

$totalLaki = $pdo->query(
    "SELECT COUNT(*) FROM karyawan WHERE jenis_kelamin = 'Laki-laki'"
)->fetchColumn();

$totalPerempuan = $pdo->query(
    "SELECT COUNT(*) FROM karyawan WHERE jenis_kelamin = 'Perempuan'"
)->fetchColumn();

$terbaru = $pdo->query("
    SELECT k.*, d.nama_divisi
    FROM karyawan k
    LEFT JOIN divisi d
    ON k.id_divisi = d.id_divisi
    ORDER BY k.id_karyawan DESC
    LIMIT 5
")->fetchAll();

$pageTitle = "Dashboard";
$activeMenu = "dashboard";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="mb-4">

    <h3 class="fw-bold">Dashboard</h3>

    <p class="text-secondary">
        Selamat datang di Sistem Informasi Direktori Karyawan.
    </p>

</div>

<div class="row g-3 mb-4">

    <div class="col-md-3">

        <div class="stat-card">

            <p class="text-secondary">Total Karyawan</p>

            <h2><?= $totalKaryawan ?></h2>

            <small>Seluruh karyawan</small>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card">

            <p class="text-secondary">Total Divisi</p>

            <h2><?= $totalDivisi ?></h2>

            <small>Divisi perusahaan</small>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card">

            <p class="text-secondary">Laki-laki</p>

            <h2><?= $totalLaki ?></h2>

            <small>Karyawan laki-laki</small>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card">

            <p class="text-secondary">Perempuan</p>

            <h2><?= $totalPerempuan ?></h2>

            <small>Karyawan perempuan</small>

        </div>

    </div>

</div>

<div class="content-card mb-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="fw-bold">Karyawan Terbaru</h5>

        <a href="../karyawan/index.php">
            Lihat Semua
        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($terbaru as $k): ?>

                    <tr>

                        <td><?= htmlspecialchars($k["nik"]) ?></td>

                        <td><?= htmlspecialchars($k["nama"]) ?></td>

                        <td><?= htmlspecialchars($k["jabatan"] ?? "-") ?></td>

                        <td><?= htmlspecialchars($k["nama_divisi"] ?? "-") ?></td>

                    </tr>

                <?php endforeach; ?>

                <?php if (!$terbaru): ?>

                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada data karyawan.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<div class="content-card">

    <h5 class="fw-bold">Akses Cepat</h5>

    <div class="d-flex flex-wrap gap-2 mt-3">

        <a href="../karyawan/tambah.php" class="btn btn-primary">
            + Tambah Karyawan
        </a>

        <a href="../divisi/tambah.php" class="btn btn-outline-primary">
            + Tambah Divisi
        </a>

        <a href="laporan.php" class="btn btn-outline-secondary">
            Lihat Laporan
        </a>

    </div>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>