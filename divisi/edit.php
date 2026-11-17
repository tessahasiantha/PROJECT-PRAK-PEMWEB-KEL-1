<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$stmt = $pdo->prepare(
    "SELECT * FROM divisi WHERE id_divisi = ?"
);

$stmt->execute([$id]);

$data = $stmt->fetch();

if (!$data) {
    exit("Data divisi tidak ditemukan.");
}

$pageTitle = "Edit Divisi";
$activeMenu = "divisi";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="content-card form-card">

    <h3 class="fw-bold mb-4">Edit Divisi</h3>

    <form action="proses_edit.php" method="POST">

        <input type="hidden"
               name="id_divisi"
               value="<?= $data["id_divisi"] ?>">

        <div class="mb-3">

            <label class="form-label">Nama Divisi</label>

            <input
                type="text"
                name="nama_divisi"
                class="form-control"
                value="<?= htmlspecialchars($data["nama_divisi"]) ?>"
                required
            >

        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <a href="index.php" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>