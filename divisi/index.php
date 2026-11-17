<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$dataDivisi = $pdo->query("
    SELECT d.*, COUNT(k.id_karyawan) AS jumlah_karyawan
    FROM divisi d
    LEFT JOIN karyawan k ON d.id_divisi = k.id_divisi
    GROUP BY d.id_divisi
    ORDER BY d.id_divisi DESC
")->fetchAll();

$pageTitle = "Data Divisi";
$activeMenu = "divisi";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold">Data Divisi</h3>
        <p class="text-secondary">Kelola divisi perusahaan.</p>
    </div>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Divisi
    </a>

</div>

<?php if (isset($_GET["status"])): ?>

    <div class="alert alert-success">

        <?php
        if ($_GET["status"] == "ditambah") echo "Divisi berhasil ditambahkan.";
        if ($_GET["status"] == "diubah") echo "Divisi berhasil diperbarui.";
        if ($_GET["status"] == "dihapus") echo "Divisi berhasil dihapus.";
        ?>

    </div>

<?php endif; ?>

<div class="content-card">

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Divisi</th>
                    <th>Jumlah Karyawan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($dataDivisi as $i => $d): ?>

                    <tr>

                        <td><?= $i + 1 ?></td>

                        <td class="fw-semibold">
                            <?= htmlspecialchars($d["nama_divisi"]) ?>
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                <?= $d["jumlah_karyawan"] ?> Karyawan
                            </span>
                        </td>

                        <td>

                            <a href="edit.php?id=<?= $d["id_divisi"] ?>"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <a href="hapus.php?id=<?= $d["id_divisi"] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Hapus divisi ini?')">
                                Hapus
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                <?php if (!$dataDivisi): ?>

                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada data divisi.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>