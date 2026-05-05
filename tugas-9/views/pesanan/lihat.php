<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container-fluid mt-4">
        <h3 class="mb-3">Lihat Pesanan</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Pelanggan</th>
                        <th class="text-center">Tanggal</th>
                        <th>Judul Buku</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanan_list)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada pesanan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pesanan_list as $p): ?>
                            <?php $rowspan = count($p['detail']); ?>
                            <?php foreach ($p['detail'] as $i => $d): ?>
                                <tr class="align-middle" data-pesanan="<?= $p['ID'] ?>">
                                    <?php if ($i === 0): ?>
                                        <td class="text-center" rowspan="<?= $rowspan ?>"><?= $p['ID'] ?></td>
                                        <td rowspan="<?= $rowspan ?>"><?= htmlspecialchars($p['Nama']) ?></td>
                                        <td class="text-center" rowspan="<?= $rowspan ?>"><?= $p['Tanggal_Pesanan'] ?></td>
                                    <?php endif; ?>
                                    <td><?= htmlspecialchars($d['Judul']) ?></td>
                                    <td class="text-center"><?= $d['Kuantitas'] ?></td>
                                    <td class="text-center">Rp <?= number_format($d['Harga_Per_Satuan'], 0, ',', '.') ?></td>
                                    <td class="text-center">Rp <?= number_format($d['Subtotal'], 0, ',', '.') ?></td>
                                    <?php if ($i === 0): ?>
                                        <td class="text-center" rowspan="<?= $rowspan ?>">Rp <?= number_format($p['Total_Harga'], 0, ',', '.') ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($total_page > 1): ?>
            <nav>
                <ul class="pagination justify-content-end">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?action=lihat&page=<?= $page - 1 ?>"><</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?action=lihat&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page >= $total_page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?action=lihat&page=<?= $page + 1 ?>">></a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.querySelectorAll('tr[data-pesanan]').forEach(row => {
        row.addEventListener('mouseenter', () => {
            const id = row.dataset.pesanan;
            document.querySelectorAll(`tr[data-pesanan="${id}"]`).forEach(r => r.classList.add('table-active'));
        });
        row.addEventListener('mouseleave', () => {
            const id = row.dataset.pesanan;
            document.querySelectorAll(`tr[data-pesanan="${id}"]`).forEach(r => r.classList.remove('table-active'));
        });
    });
    </script>
</body>
</html>