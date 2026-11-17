<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$cari = trim($_GET["cari"] ?? "");

$sql = "
    SELECT k.*, d.nama_divisi
    FROM karyawan k
    LEFT JOIN divisi d ON k.id_divisi = d.id_divisi
";

$params = [];

if ($cari !== "") {

    $sql .= "
        WHERE k.nik LIKE ?
        OR k.nama LIKE ?
        OR k.jabatan LIKE ?
        OR k.email LIKE ?
        OR d.nama_divisi LIKE ?
    ";

    $keyword = "%$cari%";

    $params = [
        $keyword,
        $keyword,
        $keyword,
        $keyword,
        $keyword
    ];
}

$sql .= " ORDER BY k.id_karyawan DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$dataKaryawan = $stmt->fetchAll();

$pageTitle = "Data Karyawan";
$activeMenu = "karyawan";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold">Data Karyawan</h3>

        <p class="text-secondary">
            Kelola informasi seluruh karyawan perusahaan.
        </p>

    </div>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Karyawan
    </a>

</div>

<?php if (isset($_GET["status"])): ?>

    <div class="alert alert-success">

        <?php
        if ($_GET["status"] == "ditambah") echo "Data berhasil ditambahkan.";
        if ($_GET["status"] == "diubah") echo "Data berhasil diperbarui.";
        if ($_GET["status"] == "dihapus") echo "Data berhasil dihapus.";
        ?>

    </div>

<?php endif; ?>

<div class="content-card">

    <form method="GET" class="row g-2 mb-4">

        <div class="col-md-5">

            <input
                type="search"
                name="cari"
                class="form-control"
                placeholder="Cari nama, NIK, jabatan..."
                value="<?= htmlspecialchars($cari) ?>"
            >

        </div>

        <div class="col-auto">

            <button class="btn btn-primary">
                Cari
            </button>

        </div>

        <div class="col-auto">

            <a href="index.php" class="btn btn-secondary">
                Reset
            </a>

        </div>

    </form>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Email</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if ($dataKaryawan): ?>

                    <?php foreach ($dataKaryawan as $i => $k): ?>

                        <tr>

                            <td><?= $i + 1 ?></td>

                            <td><?= htmlspecialchars($k["nik"]) ?></td>

                            <td class="fw-semibold">
                                <?= htmlspecialchars($k["nama"]) ?>
                            </td>

                            <td><?= htmlspecialchars($k["jabatan"] ?? "-") ?></td>

                            <td><?= htmlspecialchars($k["nama_divisi"] ?? "-") ?></td>

                            <td><?= htmlspecialchars($k["email"] ?? "-") ?></td>

                            <td class="text-nowrap">

                                <a href="detail.php?id=<?= $k["id_karyawan"] ?>"
                                   class="btn btn-sm btn-info">
                                    Detail
                                </a>

                                <a href="edit.php?id=<?= $k["id_karyawan"] ?>"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="hapus.php?id=<?= $k["id_karyawan"] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus data karyawan ini?')">
                                    Hapus
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="7" class="text-center py-4">
                            Data karyawan tidak ditemukan.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>