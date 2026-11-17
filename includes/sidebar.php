<?php
$activeMenu = $activeMenu ?? '';
?>

<aside class="sidebar">

    <div class="sidebar-brand">

        <div class="brand-icon">DK</div>

        <div>
            <h5>Direktori</h5>
            <small>Employee System</small>
        </div>

    </div>

    <div class="sidebar-label">MENU UTAMA</div>

    <a href="../dashboard/index.php"
       class="sidebar-link <?= $activeMenu == 'dashboard' ? 'active' : '' ?>">

        <span>⌂</span>
        Dashboard

    </a>

    <a href="../karyawan/index.php"
       class="sidebar-link <?= $activeMenu == 'karyawan' ? 'active' : '' ?>">

        <span>♙</span>
        Data Karyawan

    </a>

    <a href="../divisi/index.php"
       class="sidebar-link <?= $activeMenu == 'divisi' ? 'active' : '' ?>">

        <span>▦</span>
        Data Divisi

    </a>

    <a href="../dashboard/laporan.php"
       class="sidebar-link <?= $activeMenu == 'laporan' ? 'active' : '' ?>">

        <span>▤</span>
        Laporan Karyawan

    </a>

    <div class="sidebar-label">PENGATURAN</div>

    <a href="../dashboard/profil.php"
       class="sidebar-link <?= $activeMenu == 'profil' ? 'active' : '' ?>">

        <span>♙</span>
        Profil Admin

    </a>

    <a href="../auth/logout.php"
       class="sidebar-link logout-link"
       onclick="return confirm('Yakin ingin logout?')">

        <span>↪</span>
        Logout

    </a>

    <div class="sidebar-footer">

        <small>Direktori Karyawan</small>

        <p>© 2026 Employee System</p>

    </div>

</aside>