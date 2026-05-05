<?php
class Buku {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll($judul = '', $penulis = '', $tahun_terbit = '') {
        if ($judul !== '' || $penulis !== '' || $tahun_terbit !== '') {
            $stmt = $this->conn->prepare(
                "SELECT * FROM buku WHERE Judul LIKE ? AND Penulis LIKE ? AND Tahun_Terbit LIKE ?"
            );
            $s_judul   = "%$judul%";
            $s_penulis = "%$penulis%";
            $s_tahun   = "%$tahun_terbit%";
            $stmt->bind_param("sss", $s_judul, $s_penulis, $s_tahun);
            $stmt->execute();
            return $stmt->get_result();
        }
        return $this->conn->query("SELECT * FROM buku");
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM buku WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getAllAvailable() {
        return $this->conn->query("SELECT ID, Judul, Harga, stok FROM buku WHERE stok > 0 ORDER BY Judul");
    }

    public function create($judul, $penulis, $tahun_terbit, $harga, $stok) {
        $stmt = $this->conn->prepare(
            "INSERT INTO buku (Judul, Penulis, Tahun_Terbit, Harga, stok) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssdii", $judul, $penulis, $tahun_terbit, $harga, $stok);
        $ok = $stmt->execute();
        $err = $stmt->error;
        $stmt->close();
        return $ok ? true : $err;
    }

    public function update($id, $judul, $penulis, $tahun_terbit, $harga, $stok) {
        $stmt = $this->conn->prepare(
            "UPDATE buku SET Judul=?, Penulis=?, Tahun_Terbit=?, Harga=?, stok=? WHERE ID=?"
        );
        $stmt->bind_param("sssdii", $judul, $penulis, $tahun_terbit, $harga, $stok, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete($id) {
        // cek apakah buku terikat pesanan
        $stmt_check = $this->conn->prepare("SELECT COUNT(*) FROM detail_pesanan WHERE Buku_ID = ?");
        $stmt_check->bind_param("i", $id);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) return 'terikat';

        $stmt = $this->conn->prepare("DELETE FROM buku WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok ? 'berhasil' : 'gagal';
    }
}