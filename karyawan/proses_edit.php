<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, "id_karyawan", FILTER_VALIDATE_INT);

$nik = trim($_POST["nik"] ?? "");
$nama = trim($_POST["nama"] ?? "");

if (!$id || $nik === "" || $nama === "") {
    exit("Data tidak lengkap.");
}

try {

    $stmt = $pdo->prepare("
        UPDATE karyawan SET
            nik = ?,
            nama = ?,
            jenis_kelamin = ?,
            email = ?,
            no_telepon = ?,
            alamat = ?,
            jabatan = ?,
            id_divisi = ?,
            tanggal_masuk = ?
        WHERE id_karyawan = ?
    ");

    $stmt->execute([

        $nik,
        $nama,
        $_POST["jenis_kelamin"] ?: null,
        trim($_POST["email"] ?? "") ?: null,
        trim($_POST["no_telepon"] ?? "") ?: null,
        trim($_POST["alamat"] ?? "") ?: null,
        trim($_POST["jabatan"] ?? "") ?: null,
        ($_POST["id_divisi"] ?? "") !== "" ? (int)$_POST["id_divisi"] : null,
        ($_POST["tanggal_masuk"] ?? "") ?: null,
        $id

    ]);

    header("Location: index.php?status=diubah");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === "23000") {
        exit("NIK sudah digunakan oleh karyawan lain.");
    }

    exit("Gagal memperbarui data.");
}