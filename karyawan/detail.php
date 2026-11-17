<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$stmt = $pdo->prepare("
    SELECT k.*, d.nama_divisi
    FROM karyawan k
    LEFT JOIN divisi d
    ON k.id_divisi = d.id_divisi
    WHERE k.id_karyawan = ?
");

$stmt->execute([$id]);

$data = $stmt->fetch();

if (!$data) {
    exit("Data karyawan tidak ditemukan.");
}

$pageTitle = "Detail Karyawan";
$activeMenu = "karyawan";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="content-card">

    <h3 class="fw-bold mb-4">Detail Karyawan</h3>

    <div class="row g-3">

        <div class="col-md-6">
            <label class="text-secondary">NIK</label>
            <h6><?= htmlspecialchars($data["nik"]) ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Nama Lengkap</label>
            <h6><?= htmlspecialchars($data["nama"]) ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Jenis Kelamin</label>
            <h6><?= htmlspecialchars($data["jenis_kelamin"] ?? "-") ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Email</label>
            <h6><?= htmlspecialchars($data["email"] ?? "-") ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Nomor Telepon</label>
            <h6><?= htmlspecialchars($data["no_telepon"] ?? "-") ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Jabatan</label>
            <h6><?= htmlspecialchars($data["jabatan"] ?? "-") ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Divisi</label>
            <h6><?= htmlspecialchars($data["nama_divisi"] ?? "-") ?></h6>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Tanggal Masuk</label>
            <h6><?= htmlspecialchars($data["tanggal_masuk"] ?? "-") ?></h6>
        </div>

        <div class="col-12">
            <label class="text-secondary">Alamat</label>
            <h6><?= nl2br(htmlspecialchars($data["alamat"] ?? "-")) ?></h6>
        </div>

    </div>

    <div class="mt-4">

        <a href="edit.php?id=<?= $data["id_karyawan"] ?>"
           class="btn btn-warning">
            Edit Data
        </a>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>