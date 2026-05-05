<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container-fluid mt-4">
        <h3 class="mb-3">Edit Buku</h3>

        <form action="?action=edit&id=<?= $id ?>" method="POST">
            <div class="row g-2 align-items-end">
                <div class="col-md">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" required class="form-control"
                        value="<?= htmlspecialchars($buku['Judul']) ?>">
                </div>
                <div class="col-md">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" required class="form-control"
                        value="<?= htmlspecialchars($buku['Penulis']) ?>">
                </div>
                <div class="col-md">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" required class="form-control"
                        value="<?= htmlspecialchars($buku['Tahun_Terbit']) ?>">
                </div>
                <div class="col-md">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" required class="form-control"
                        value="<?= $buku['Harga'] ?>">
                </div>
                <div class="col-md">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" required class="form-control"
                        value="<?= $buku['stok'] ?>">
                </div>
                <div class="col-md-auto">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
                <div class="col-md-auto">
                    <a href="?action=daftar" class="btn btn-secondary w-100">Batal</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>