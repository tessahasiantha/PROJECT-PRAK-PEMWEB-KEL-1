<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard/index.php");
    exit;
}

$error = $_SESSION['login_error'] ?? "";
unset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Direktori Karyawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="login-page">

<div class="login-card">

    <div class="text-center mb-4">

        <div class="brand-icon mx-auto mb-3">
            DK
        </div>

        <h3 class="fw-bold">Direktori Karyawan</h3>

        <p class="text-secondary">
            Silakan login untuk melanjutkan
        </p>

    </div>

    <?php if ($error): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>

    <form action="proses_login.php" method="POST">

        <div class="mb-3">

            <label class="form-label">Username</label>

            <input
                type="text"
                name="username"
                class="form-control"
                placeholder="Masukkan username"
                required
            >

        </div>

        <div class="mb-4">

            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                required
            >

        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>

    </form>

    <p class="text-center mt-4">

        Belum punya akun?

        <a href="register.php">
            Daftar Sekarang
        </a>

    </p>

</div>

</body>
</html>