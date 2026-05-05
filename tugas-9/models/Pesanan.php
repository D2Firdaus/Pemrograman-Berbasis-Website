<?php
class Pesanan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPelanggan() {
        return $this->conn->query("SELECT ID, Nama FROM pelanggan ORDER BY Nama");
    }

    public function getTotalCount() {
        return $this->conn->query("SELECT COUNT(*) FROM pesanan")->fetch_row()[0];
    }

    public function getPage($per_page, $offset) {
        $stmt = $this->conn->prepare(
            "SELECT ID FROM pesanan ORDER BY Tanggal_Pesanan DESC, ID DESC LIMIT ? OFFSET ?"
        );
        $stmt->bind_param("ii", $per_page, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $ids = [];
        while ($r = $result->fetch_assoc()) {
            $ids[] = $r['ID'];
        }
        return $ids;
    }

    public function getDetailByIds(array $ids) {
        if (empty($ids)) return [];

        $placeholders = implode(',', $ids);
        $sql = "SELECT p.ID, p.Tanggal_Pesanan, p.Total_Harga, pl.Nama,
                       b.Judul, dp.Kuantitas, dp.Harga_Per_Satuan,
                       (dp.Kuantitas * dp.Harga_Per_Satuan) AS Subtotal
                FROM pesanan p
                JOIN pelanggan pl ON p.Pelanggan_ID = pl.ID
                JOIN detail_pesanan dp ON dp.Pesanan_ID = p.ID
                JOIN buku b ON b.ID = dp.Buku_ID
                WHERE p.ID IN ($placeholders)
                ORDER BY p.Tanggal_Pesanan DESC, p.ID DESC";

        $result = $this->conn->query($sql);
        $list   = [];
        while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            if (!isset($list[$id])) {
                $list[$id] = [
                    'ID'              => $row['ID'],
                    'Nama'            => $row['Nama'],
                    'Tanggal_Pesanan' => $row['Tanggal_Pesanan'],
                    'Total_Harga'     => $row['Total_Harga'],
                    'detail'          => [],
                ];
            }
            $list[$id]['detail'][] = [
                'Judul'            => $row['Judul'],
                'Kuantitas'        => $row['Kuantitas'],
                'Harga_Per_Satuan' => $row['Harga_Per_Satuan'],
                'Subtotal'         => $row['Subtotal'],
            ];
        }
        return $list;
    }

    public function create($pelanggan_id, array $buku_ids, array $kuantitas) {
        $total_harga = 0;
        $buku_list   = [];

        foreach ($buku_ids as $i => $buku_id) {
            $qty = (int) $kuantitas[$i];
            if ($qty <= 0) continue;

            $stmt_buku = $this->conn->prepare("SELECT Harga, stok FROM buku WHERE ID = ?");
            $stmt_buku->bind_param("i", $buku_id);
            $stmt_buku->execute();
            $row = $stmt_buku->get_result()->fetch_assoc();
            $stmt_buku->close();

            if (!$row || $row['stok'] < $qty) continue;

            $harga_satuan  = $row['Harga'];
            $total_harga  += $harga_satuan * $qty;
            $buku_list[]   = [
                'buku_id'      => $buku_id,
                'kuantitas'    => $qty,
                'harga_satuan' => $harga_satuan,
            ];
        }

        if (empty($buku_list)) return false;

        $tanggal      = date('Y-m-d');
        $stmt_pesanan = $this->conn->prepare(
            "INSERT INTO pesanan (Tanggal_Pesanan, Pelanggan_ID, Total_Harga) VALUES (?, ?, ?)"
        );
        $stmt_pesanan->bind_param("sid", $tanggal, $pelanggan_id, $total_harga);
        $stmt_pesanan->execute();
        $pesanan_id = $this->conn->insert_id;
        $stmt_pesanan->close();

        foreach ($buku_list as $item) {
            $stmt_detail = $this->conn->prepare(
                "INSERT INTO detail_pesanan (Pesanan_ID, Buku_ID, Kuantitas, Harga_Per_Satuan) VALUES (?, ?, ?, ?)"
            );
            $stmt_detail->bind_param("iiid", $pesanan_id, $item['buku_id'], $item['kuantitas'], $item['harga_satuan']);
            $stmt_detail->execute();
            $stmt_detail->close();

            $stmt_stok = $this->conn->prepare("UPDATE buku SET stok = stok - ? WHERE ID = ?");
            $stmt_stok->bind_param("ii", $item['kuantitas'], $item['buku_id']);
            $stmt_stok->execute();
            $stmt_stok->close();
        }

        return true;
    }
}