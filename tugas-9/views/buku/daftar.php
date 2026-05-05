    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Buku</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php require_once __DIR__ . '/../layout/navbar.php'; ?>

        <div class="container-fluid mt-4">
            <h3 class="mb-3">Daftar Buku</h3>

            <?php if ($status): ?>
                <div class="alert <?= match($status) {
                    'berhasil', 'diperbarui' => 'alert-success',
                    'terikat', 'gagal'       => 'alert-danger',
                    default                  => 'alert-warning'
                } ?> alert-dismissible fade show" role="alert">
                    <?= match($status) {
                        'berhasil'   => 'Data berhasil dihapus.',
                        'diperbarui' => 'Data berhasil diperbarui.',
                        'terikat'    => 'Gagal! Buku terikat dengan data pesanan.',
                        'gagal'      => 'Gagal menghapus data.',
                        default      => 'Akses tidak valid.'
                    } ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="GET" action="" class="mb-3">
                <input type="hidden" name="action" value="daftar">
                <div class="row g-2 align-items-end">
                    <div class="col-md">
                        <label class="form-label" for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control"
                            placeholder="Masukkan Judul" value="<?= htmlspecialchars($judul) ?>">
                    </div>
                    <div class="col-md">
                        <label class="form-label" for="penulis">Penulis</label>
                        <input type="text" id="penulis" name="penulis" class="form-control"
                            placeholder="Masukkan Penulis" value="<?= htmlspecialchars($penulis) ?>">
                    </div>
                    <div class="col-md">
                        <label class="form-label" for="tahun_terbit">Tahun Terbit</label>
                        <input type="text" id="tahun_terbit" name="tahun_terbit" class="form-control"
                            placeholder="Masukkan Tahun Terbit" value="<?= htmlspecialchars($tahun_terbit) ?>">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                    <div class="col-md-auto">
                        <a href="?action=daftar" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th class="text-center">Tahun Terbit</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows == 0): ?>
                            <tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>
                        <?php else: ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?= $row['ID'] ?></td>
                                    <td><?= htmlspecialchars($row['Judul']) ?></td>
                                    <td><?= htmlspecialchars($row['Penulis']) ?></td>
                                    <td class="text-center"><?= $row['Tahun_Terbit'] ?></td>
                                    <td class="text-center">Rp <?= number_format($row['Harga'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $row['stok'] ?></td>
                                    <td class="text-center">
                                        <a href="?action=edit&id=<?= $row['ID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <form action="?action=hapus" method="POST"
                                            onsubmit="return confirm('Yakin hapus buku ini?')">
                                            <input type="hidden" name="id" value="<?= $row['ID'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>