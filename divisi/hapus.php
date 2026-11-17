<?php

require_once __DIR__ . "/../includes/auth_check.php";
require_once __DIR__ . "/../config/koneksi.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare(
    "DELETE FROM divisi WHERE id_divisi = ?"
);

$stmt->execute([$id]);

header("Location: index.php?status=dihapus");
exit;