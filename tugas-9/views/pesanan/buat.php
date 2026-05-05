<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container-fluid mt-4">
        <h3 class="mb-3">Buat Pesanan</h3>

        <?php if ($status === 'berhasil'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Pesanan berhasil dibuat.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($status === 'gagal'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Pesanan gagal dibuat. Periksa kembali data yang dimasukkan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="?action=buat" method="POST">
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Pelanggan</label>
                    <select name="pelanggan_id" class="form-select" required>
                        <option value="" disabled selected> Pilih Pelanggan </option>
                        <?php foreach ($pelanggan_list as $p): ?>
                            <option value="<?= $p['ID'] ?>"><?= htmlspecialchars($p['Nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">Detail Buku</label>
                    <div id="buku-container">
                        <div class="row g-2 mb-2 buku-row align-items-end">
                            <div class="col-md-6">
                                <select name="buku_id[]" class="form-select buku-select" required>
                                    <option value="" disabled selected> Pilih Buku </option>
                                    <?php foreach ($buku_list_all as $b): ?>
                                        <option value="<?= $b['ID'] ?>" data-harga="<?= $b['Harga'] ?>" data-stok="<?= $b['stok'] ?>">
                                            <?= htmlspecialchars($b['Judul']) ?> (Stok: <?= $b['stok'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="kuantitas[]" class="form-control kuantitas-input" placeholder="Kuantitas" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger w-100 btn-hapus-buku" disabled>−</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary btn-sm mt-1" id="btn-tambah-buku">+ Tambah Buku</button>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Total Harga</label>
                    <input type="text" id="total-harga-display" class="form-control fw-bold" readonly value="Rp 0">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const bukuData = <?= json_encode(
        array_map(fn($b) => [
            'id'    => $b['ID'],
            'harga' => $b['Harga'],
            'stok'  => $b['stok'],
        ], iterator_to_array($buku_list_all))
    ) ?>;

    const bukuMap = {};
    bukuData.forEach(b => bukuMap[b.id] = b);

    function formatRp(angka) {
        return 'Rp ' + parseInt(angka || 0).toLocaleString('id-ID');
    }

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.buku-row').forEach(row => {
            const sel = row.querySelector('.buku-select');
            const qty = parseInt(row.querySelector('.kuantitas-input').value) || 0;
            const buku = bukuMap[sel.value];
            const subtotal = buku ? buku.harga * qty : 0;
            row.querySelector('.subtotal-display').value = formatRp(subtotal);
            total += subtotal;
        });
        document.getElementById('total-harga-display').value = formatRp(total);
    }

    function buatBarisBuku(template = null) {
        const container = document.getElementById('buku-container');
        const firstRow  = container.querySelector('.buku-row');
        const newRow    = firstRow.cloneNode(true);

        newRow.querySelector('.buku-select').value        = '';
        newRow.querySelector('.kuantitas-input').value    = '';
        newRow.querySelector('.subtotal-display').value   = '';
        newRow.querySelector('.btn-hapus-buku').disabled  = false;

        newRow.querySelector('.buku-select').addEventListener('change', hitungTotal);
        newRow.querySelector('.kuantitas-input').addEventListener('input', hitungTotal);
        newRow.querySelector('.btn-hapus-buku').addEventListener('click', function () {
            newRow.remove();
            updateHapusButtons();
            hitungTotal();
        });

        container.appendChild(newRow);
        updateHapusButtons();
    }

    function updateHapusButtons() {
        const rows = document.querySelectorAll('.buku-row');
        rows.forEach((row, i) => {
            row.querySelector('.btn-hapus-buku').disabled = rows.length === 1;
        });
    }

    // Event listener baris pertama
    document.querySelector('.buku-select').addEventListener('change', hitungTotal);
    document.querySelector('.kuantitas-input').addEventListener('input', hitungTotal);

    document.getElementById('btn-tambah-buku').addEventListener('click', () => buatBarisBuku());
    </script>
</body>
</html>