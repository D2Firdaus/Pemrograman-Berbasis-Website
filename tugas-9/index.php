<?php
require_once __DIR__ . '/config/config.php';

$page = $_GET['page'] ?? 'pesanan';

switch ($page) {
    case 'buku':
        header("Location: {$base_url}controllers/BukuController.php?action=daftar");
        break;
    case 'pesanan':
    default:
        header("Location: {$base_url}controllers/PesananController.php?action=lihat");
        break;
}
exit;

