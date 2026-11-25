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

    // Cookie untuk mengingat username selama 30 hari
    if (isset($_POST["remember_username"])) {

        setcookie(
            "remember_username",
            $username,
            [
                "expires" => time() + (30 * 24 * 60 * 60),
                "path" => "/",
                "httponly" => true,
                "samesite" => "Lax"
            ]
        );

    } else {

        // Hapus Cookie jika pilihan tidak dicentang
        setcookie(
            "remember_username",
            "",
            [
                "expires" => time() - 3600,
                "path" => "/",
                "httponly" => true,
                "samesite" => "Lax"
            ]
        );
    }

    header("Location: ../dashboard/index.php");
    exit;
}

$_SESSION["login_error"] = "Username atau password salah.";

header("Location: login.php");
exit;
