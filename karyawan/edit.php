<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$stmt = $pdo->prepare(
    "SELECT * FROM karyawan WHERE id_karyawan = ?"
);

$stmt->execute([$id]);

$data = $stmt->fetch();

if (!$data) {
    exit("Data karyawan tidak ditemukan.");
}

$divisi = $pdo->query(
    "SELECT * FROM divisi ORDER BY nama_divisi"
)->fetchAll();

$pageTitle = "Edit Karyawan";
$activeMenu = "karyawan";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="content-card form-card">

    <h3 class="fw-bold mb-4">Edit Data Karyawan</h3>

    <form action="proses_edit.php" method="POST">

        <input type="hidden"
               name="id_karyawan"
               value="<?= $data["id_karyawan"] ?>">

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control"
                       value="<?= htmlspecialchars($data["nik"]) ?>"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control"
                       value="<?= htmlspecialchars($data["nama"]) ?>"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki"
                        <?= $data["jenis_kelamin"] == "Laki-laki" ? "selected" : "" ?>>
                        Laki-laki
                    </option>
                    <option value="Perempuan"
                        <?= $data["jenis_kelamin"] == "Perempuan" ? "selected" : "" ?>>
                        Perempuan
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($data["email"] ?? "") ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="no_telepon" class="form-control"
                       value="<?= htmlspecialchars($data["no_telepon"] ?? "") ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control"
                       value="<?= htmlspecialchars($data["jabatan"] ?? "") ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Divisi</label>
                <select name="id_divisi" class="form-select">
                    <option value="">Pilih Divisi</option>

                    <?php foreach ($divisi as $d): ?>
                        <option value="<?= $d["id_divisi"] ?>"
                            <?= $data["id_divisi"] == $d["id_divisi"] ? "selected" : "" ?>>
                            <?= htmlspecialchars($d["nama_divisi"]) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control"
                       value="<?= htmlspecialchars($data["tanggal_masuk"] ?? "") ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($data["alamat"] ?? "") ?></textarea>
            </div>

        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>