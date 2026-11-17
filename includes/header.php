<?php

$pageTitle = $pageTitle ?? "Dashboard";
$activeMenu = $activeMenu ?? "";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?= htmlspecialchars($pageTitle) ?> | Direktori Karyawan
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="app-wrapper">

    <?php require __DIR__ . "/sidebar.php"; ?>

    <div class="main-content">

        <header class="topbar">

            <div>

                <h6 class="mb-1 fw-bold">
                    <?= htmlspecialchars($pageTitle) ?>
                </h6>

                <small class="text-secondary">
                    Sistem Informasi Direktori Karyawan
                </small>

            </div>

            <div class="admin-info">

                <div class="admin-avatar">

                    <?= strtoupper(substr($_SESSION["username"] ?? "A", 0, 1)) ?>

                </div>

                <div>

                    <strong>
                        <?= htmlspecialchars($_SESSION["username"] ?? "Admin") ?>
                    </strong>

                    <small>Administrator</small>

                </div>

            </div>

        </header>

        <main class="page-content">