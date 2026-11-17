<?php

session_start();

require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE username = ? LIMIT 1"
);

$stmt->execute([$username]);

$user = $stmt->fetch();

if ($user && password_verify($password, $user["password"])) {

    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];

    header("Location: ../dashboard/index.php");
    exit;

}

$_SESSION["login_error"] = "Username atau password salah.";

header("Location: login.php");
exit;