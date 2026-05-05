<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/koneksi.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {

    case 'login':
        // Jika sudah login, langsung ke index
        if (isset($_SESSION['login_Un51k4']) && $_SESSION['login_Un51k4'] === true) {
            header("Location: {$base_url}index.php");
            exit;
        }
        $message = $_GET['message'] ?? null;
        require_once __DIR__ . '/../views/auth/login.php';
        break;

    case 'proses':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT id, nama, katasandi FROM pengguna WHERE nama = ? AND katasandi = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                $_SESSION['id']           = $user['id'];
                $_SESSION['nama']         = $user['nama'];
                $_SESSION['login_Un51k4'] = true;
                header("Location: {$base_url}index.php");
            } else {
                header("Location: {$base_url}login?message=" . urlencode("Username atau password salah."));
            }

            $stmt->close();
            $conn->close();
            exit;
        }
        header("Location: {$base_url}controllers/AuthController.php?action=login");
        exit;

    case 'logout':
        $_SESSION = [];
        session_destroy();
        header("Location: {$base_url}login?message=" . urlencode("Berhasil logout."));
        exit;

    default:
        header("Location: {$base_url}controllers/AuthController.php?action=login");
        exit;
}