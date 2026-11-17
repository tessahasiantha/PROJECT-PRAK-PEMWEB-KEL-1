<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$divisi = $pdo->query(
    "SELECT * FROM divisi ORDER BY nama_divisi"
)->fetchAll();

$pageTitle = "Tambah Karyawan";
$activeMenu = "karyawan";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="content-card form-card">

    <h3 class="fw-bold mb-4">Tambah Karyawan</h3>

    <form action="proses_tambah.php" method="POST">

        <div class="row g-3">

            <div class="col-md-6">

                <label class="form-label">NIK</label>

                <input type="text" name="nik"
                       class="form-control" maxlength="30" required>

            </div>

            <div class="col-md-6">

                <label class="form-label">Nama Lengkap</label>

                <input type="text" name="nama"
                       class="form-control" maxlength="100" required>

            </div>

            <div class="col-md-6">

                <label class="form-label">Jenis Kelamin</label>

                <select name="jenis_kelamin" class="form-select">

                    <option value="">Pilih Jenis Kelamin</option>

                    <option value="Laki-laki">Laki-laki</option>

                    <option value="Perempuan">Perempuan</option>

                </select>

            </div>

            <div class="col-md-6">

                <label class="form-label">Email</label>

                <input type="email" name="email"
                       class="form-control">

            </div>

            <div class="col-md-6">

                <label class="form-label">Nomor Telepon</label>

                <input type="text" name="no_telepon"
                       class="form-control">

            </div>

            <div class="col-md-6">

                <label class="form-label">Jabatan</label>

                <input type="text" name="jabatan"
                       class="form-control">

            </div>

            <div class="col-md-6">

                <label class="form-label">Divisi</label>

                <select name="id_divisi" class="form-select">

                    <option value="">Pilih Divisi</option>

                    <?php foreach ($divisi as $d): ?>

                        <option value="<?= $d["id_divisi"] ?>">

                            <?= htmlspecialchars($d["nama_divisi"]) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-6">

                <label class="form-label">Tanggal Masuk</label>

                <input type="date" name="tanggal_masuk"
                       class="form-control">

            </div>

            <div class="col-12">

                <label class="form-label">Alamat</label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3"></textarea>

            </div>

        </div>

        <div class="mt-4">

            <button type="submit" class="btn btn-primary">
                Simpan Data
            </button>

            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </form>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>