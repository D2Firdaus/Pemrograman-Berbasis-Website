<?php require_once __DIR__ . '/../../config/config.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="<?= $base_url ?>index.php">Toko Buku Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url ?>buku">Daftar Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url ?>buku/tambah">Tambah Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url ?>pesanan">Lihat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url ?>pesanan/buat">Buat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= $base_url ?>logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>