<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$laporan = $pdo->query("
    SELECT
        d.nama_divisi,
        COUNT(k.id_karyawan) AS jumlah
    FROM divisi d
    LEFT JOIN karyawan k
        ON d.id_divisi = k.id_divisi
    GROUP BY d.id_divisi
    ORDER BY jumlah DESC
")->fetchAll();

$total = $pdo->query(
    "SELECT COUNT(*) FROM karyawan"
)->fetchColumn();

$pageTitle = "Laporan Karyawan";
$activeMenu = "laporan";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="mb-4">

    <h3 class="fw-bold">Laporan Karyawan</h3>

    <p class="text-secondary">
        Rekapitulasi data karyawan berdasarkan divisi.
    </p>

</div>

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="fw-bold">Rekapitulasi Divisi</h5>

        <button onclick="window.print()"
                class="btn btn-outline-primary">
            Cetak Laporan
        </button>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Divisi</th>
                    <th>Jumlah Karyawan</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($laporan as $i => $d): ?>

                    <tr>

                        <td><?= $i + 1 ?></td>

                        <td><?= htmlspecialchars($d["nama_divisi"]) ?></td>

                        <td><?= $d["jumlah"] ?></td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

            <tfoot>

                <tr class="fw-bold">

                    <td colspan="2">Total Seluruh Karyawan</td>

                    <td><?= $total ?></td>

                </tr>

            </tfoot>

        </table>

    </div>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>