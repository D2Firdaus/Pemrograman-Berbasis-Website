<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container-fluid mt-4">
        <h3 class="mb-3">Tambah Buku</h3>

        <?php if ($message): ?>
            <div class="alert <?= str_starts_with($message, 'Error') ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="?action=tambah" method="POST">
            <div class="row g-2 align-items-end">
                <div class="col-md">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" placeholder="Masukkan Judul" required class="form-control">
                </div>
                <div class="col-md">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" placeholder="Masukkan Penulis" required class="form-control">
                </div>
                <div class="col-md">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" placeholder="Masukkan Tahun Terbit" required class="form-control">
                </div>
                <div class="col-md">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" placeholder="Masukkan Harga" required class="form-control">
                </div>
                <div class="col-md">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" placeholder="Masukkan Stok" required class="form-control">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>