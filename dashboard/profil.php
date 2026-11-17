<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$stmt = $pdo->prepare(
    "SELECT username, created_at FROM users WHERE id = ?"
);

$stmt->execute([$_SESSION["user_id"]]);

$admin = $stmt->fetch();

if (!$admin) {
    exit("Data admin tidak ditemukan.");
}

$pageTitle = "Profil Admin";
$activeMenu = "profil";

require_once __DIR__ . "/../includes/header.php";

?>

<div class="mb-4">

    <h3 class="fw-bold">Profil Admin</h3>

    <p class="text-secondary">
        Informasi akun administrator.
    </p>

</div>

<div class="content-card" style="max-width:650px">

    <div class="text-center mb-4">

        <div class="admin-avatar mx-auto"
             style="width:85px;height:85px;font-size:30px">

            <?= strtoupper(substr($admin["username"], 0, 1)) ?>

        </div>

        <h4 class="fw-bold mt-3">

            <?= htmlspecialchars($admin["username"]) ?>

        </h4>

        <span class="badge bg-primary">
            Administrator
        </span>

    </div>

    <hr>

    <div class="mb-3">

        <label class="text-secondary">Username</label>

        <h6>
            <?= htmlspecialchars($admin["username"]) ?>
        </h6>

    </div>

    <div class="mb-3">

        <label class="text-secondary">Tanggal Pendaftaran</label>

        <h6>
            <?= htmlspecialchars($admin["created_at"]) ?>
        </h6>

    </div>

    <div class="mb-3">

        <label class="text-secondary">Status Akun</label>

        <h6 class="text-success">
            Aktif
        </h6>

    </div>

</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>