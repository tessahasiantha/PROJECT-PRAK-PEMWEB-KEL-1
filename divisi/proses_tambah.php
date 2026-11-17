<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nama = trim($_POST["nama_divisi"] ?? "");

if ($nama === "") {
    exit("Nama divisi wajib diisi.");
}

try {

    $stmt = $pdo->prepare(
        "INSERT INTO divisi (nama_divisi) VALUES (?)"
    );

    $stmt->execute([$nama]);

    header("Location: index.php?status=ditambah");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === "23000") {
        exit("Nama divisi sudah tersedia.");
    }

    exit("Gagal menambahkan divisi.");
}