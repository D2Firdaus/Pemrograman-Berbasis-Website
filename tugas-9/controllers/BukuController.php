<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../auth/check.php';
require_once __DIR__ . '/../models/Buku.php';

$bukuModel = new Buku($conn);
$action    = $_GET['action'] ?? 'daftar';

switch ($action) {

    case 'daftar':
        $judul        = $_GET['judul']        ?? '';
        $penulis      = $_GET['penulis']      ?? '';
        $tahun_terbit = $_GET['tahun_terbit'] ?? '';
        $result       = $bukuModel->getAll($judul, $penulis, $tahun_terbit);
        $status       = $_GET['status']       ?? null;
        require_once __DIR__ . '/../views/buku/daftar.php';
        break;

    case 'tambah':
        $message = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ret = $bukuModel->create(
                $_POST['judul'],
                $_POST['penulis'],
                $_POST['tahun_terbit'],
                $_POST['harga'],
                $_POST['stok']
            );
            $message = ($ret === true) ? 'Buku berhasil ditambahkan!' : 'Error: ' . $ret;
        }
        require_once __DIR__ . '/../views/buku/tambah.php';
        break;

    case 'edit':
        if (!isset($_GET['id'])) {
            header("Location: {$base_url}buku?status=invalid");
            exit;
        }
        $id   = (int) $_GET['id'];
        $buku = $bukuModel->getById($id);
        if (!$buku) {
            header("Location: {$base_url}buku?status=notfound");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $ok = $bukuModel->update(
                $id,
                $_POST['judul'],
                $_POST['penulis'],
                $_POST['tahun_terbit'],
                $_POST['harga'],
                $_POST['stok']
            );
            header("Location: {$base_url}buku?status=" . ($ok ? 'diperbarui' : 'gagal'));
            exit;
        }
        require_once __DIR__ . '/../views/buku/edit.php';
        break;

    case 'hapus':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $status = $bukuModel->delete((int) $_POST['id']);
        } else {
            $status = 'invalid';
        }
        header("Location: {$base_url}buku?status={$status}");
        exit;

    default:
        header("Location: {$base_url}buku");
        exit;
}

$conn->close();