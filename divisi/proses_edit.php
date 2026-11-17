<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, "id_divisi", FILTER_VALIDATE_INT);
$nama = trim($_POST["nama_divisi"] ?? "");

if (!$id || $nama === "") {
    exit("Data tidak valid.");
}

try {

    $stmt = $pdo->prepare(
        "UPDATE divisi SET nama_divisi = ? WHERE id_divisi = ?"
    );

    $stmt->execute([$nama, $id]);

    header("Location: index.php?status=diubah");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === "23000") {
        exit("Nama divisi sudah digunakan.");
    }

    exit("Gagal memperbarui divisi.");
}