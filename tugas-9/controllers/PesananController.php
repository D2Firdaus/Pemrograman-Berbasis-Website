<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../auth/check.php';
require_once __DIR__ . '/../models/Pesanan.php';
require_once __DIR__ . '/../models/Buku.php';

$pesananModel = new Pesanan($conn);
$bukuModel    = new Buku($conn);
$action       = $_GET['action'] ?? 'lihat';

switch ($action) {

    case 'lihat':
        $per_page      = 10;
        $page          = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $offset        = ($page - 1) * $per_page;
        $total_pesanan = $pesananModel->getTotalCount();
        $total_page    = ceil($total_pesanan / $per_page);
        $ids           = $pesananModel->getPage($per_page, $offset);
        $pesanan_list  = $pesananModel->getDetailByIds($ids);
        require_once __DIR__ . '/../views/pesanan/lihat.php';
        break;

    case 'buat':
        $status = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok     = $pesananModel->create($_POST['pelanggan_id'], $_POST['buku_id'], $_POST['kuantitas']);
            $status = $ok ? 'berhasil' : 'gagal';
        }
        $pelanggan_list = $pesananModel->getPelanggan();
        $buku_list_all  = $bukuModel->getAllAvailable();
        require_once __DIR__ . '/../views/pesanan/buat.php';
        break;

    default:
        header("Location: {$base_url}pesanan");
        exit;
}

$conn->close();