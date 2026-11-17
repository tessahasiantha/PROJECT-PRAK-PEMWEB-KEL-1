<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nik = trim($_POST["nik"] ?? "");
$nama = trim($_POST["nama"] ?? "");

if ($nik === "" || $nama === "") {
    exit("NIK dan nama wajib diisi.");
}

try {

    $stmt = $pdo->prepare("
        INSERT INTO karyawan
        (
            nik,
            nama,
            jenis_kelamin,
            email,
            no_telepon,
            alamat,
            jabatan,
            id_divisi,
            tanggal_masuk
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
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
        ($_POST["tanggal_masuk"] ?? "") ?: null

    ]);

    header("Location: index.php?status=ditambah");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === "23000") {
        exit("NIK sudah digunakan.");
    }

    exit("Gagal menambahkan data karyawan.");
}