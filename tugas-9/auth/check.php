<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION['login_Un51k4']) || $_SESSION['login_Un51k4'] !== true) {
    header("Location: " . $base_url . "login?message=" . urlencode("Silakan login terlebih dahulu."));
    exit;
}