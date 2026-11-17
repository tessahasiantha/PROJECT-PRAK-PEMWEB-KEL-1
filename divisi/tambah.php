<?php

require_once __DIR__ . "/../includes/auth_check.php";

$pageTitle = "Tambah Divisi";
$activeMenu = "divisi";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="content-card form-card">

    <h3 class="fw-bold mb-4">Tambah Divisi</h3>

    <form action="proses_tambah.php" method="POST">

        <div class="mb-3">

            <label class="form-label">Nama Divisi</label>

            <input
                type="text"
                name="nama_divisi"
                class="form-control"
                placeholder="Masukkan nama divisi"
                maxlength="100"
                required
            >

        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>