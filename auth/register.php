<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard/index.php");
    exit;
}

$error = $_SESSION["register_error"] ?? "";
unset($_SESSION["register_error"]);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Signup - Direktori Karyawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="login-page">

<div class="login-card">

    <div class="text-center mb-4">

        <div class="brand-icon mx-auto mb-3">
            DK
        </div>

        <h3 class="fw-bold">Buat Akun</h3>

        <p class="text-secondary">
            Daftarkan akun administrator
        </p>

    </div>

    <?php if ($error): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>

    <form action="proses_register.php" method="POST">

        <div class="mb-3">

            <label class="form-label">Username</label>

            <input
                type="text"
                name="username"
                class="form-control"
                minlength="4"
                maxlength="50"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                minlength="8"
                required
            >

        </div>

        <div class="mb-4">

            <label class="form-label">Konfirmasi Password</label>

            <input
                type="password"
                name="confirm_password"
                class="form-control"
                minlength="8"
                required
            >

        </div>

        <button type="submit" class="btn btn-primary w-100">
            Daftar Sekarang
        </button>

    </form>

    <p class="text-center mt-4">

        Sudah punya akun?

        <a href="login.php">
            Login
        </a>

    </p>

</div>

</body>
</html>