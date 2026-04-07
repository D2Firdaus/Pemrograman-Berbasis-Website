<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Checker</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <form method="post" action="">
        Nama: <input type="text" name="nama"><br>
        Nilai: <input type="number" name="nilai"><br>
        <input type="submit" name="submit" value="Proses">
        <?php
        // Cek apakah form telah disubmit
        if (isset($_POST['submit'])) {
            // Validasi input
            if (!empty($_POST['nama']) && !empty($_POST['nilai']) && $_POST['nilai'] >= 0 && $_POST['nilai'] <= 100) {
                $nama = $_POST['nama'];
                $nilai = $_POST['nilai'];
                $predikat = null;
                $status = "Lulus";

                // Tentukan predikat berdasarkan nilai
                if ($nilai >= 85) {
                    $predikat = "A";
                } else if ($nilai >= 75) {
                    $predikat = "B";
                } else if ($nilai >= 65) {
                    $predikat = "C";
                } else if ($nilai >= 50) {
                    $predikat = "D";
                } else {
                    $predikat = "E";
                    $status = "Tidak Lulus";
                }

                // Tampilkan hasil
                echo "<br>Nama: " . $nama . "<br>";
                echo "Nilai: " . $nilai . "<br>";
                echo "Predikat: " . $predikat . "<br>";
                echo "Status: " . $status . "<br>";

            } else {
                echo "<br>Input tidak valid. Pastikan nama tidak kosong dan nilai antara 0-100.";
            }
        }
        ?>
    </form>
</body>

</html>