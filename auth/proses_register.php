<?php

session_start();

require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit;
}

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$confirm = $_POST["confirm_password"] ?? "";

if (strlen($username) < 4 || strlen($username) > 50) {

    $_SESSION["register_error"] = "Username harus 4-50 karakter.";

    header("Location: register.php");
    exit;
}

if (strlen($password) < 8) {

    $_SESSION["register_error"] = "Password minimal 8 karakter.";

    header("Location: register.php");
    exit;
}

if ($password !== $confirm) {

    $_SESSION["register_error"] = "Konfirmasi password tidak cocok.";

    header("Location: register.php");
    exit;
}

$stmt = $pdo->prepare(
    "SELECT id FROM users WHERE username = ?"
);

$stmt->execute([$username]);

if ($stmt->fetch()) {

    $_SESSION["register_error"] = "Username sudah digunakan.";

    header("Location: register.php");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    "INSERT INTO users (username, password) VALUES (?, ?)"
);

$stmt->execute([$username, $hash]);

session_regenerate_id(true);

$_SESSION["user_id"] = $pdo->lastInsertId();
$_SESSION["username"] = $username;

header("Location: ../dashboard/index.php");
exit;