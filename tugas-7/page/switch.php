<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Soal 1</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/page.css">
</head>

<body>
    <h1>Pengecekan jenis kendaraan berdasarkan jumlah roda </h1>
    <?php include "../include/navbar.php"; ?>
    <form action="" method="post">
        <label for="jumlahroda">Jumlah roda :</label>
        <input type="number" name="jumlahroda">
        <input type="submit" name="submit">

        <?php
        echo "<br>";
        if (!empty($_POST['jumlahroda'])) {
            $jumlahroda = $_POST['jumlahroda'];
            if (isset($_POST['submit'])) {
                echo "<br>";
                 echo "<span style='color: var(--secondary-color); font-weight: 500;'>";
                switch ($jumlahroda) {
                    case 2:
                        echo "Sepeda";
                        break;
                    case 4:
                        echo "Mobil";
                        break;
                    case 6:
                        echo "Truk";
                        break;
                    default:
                        echo "Jumlah roda tidak valid";
                }
            }
        }
        ?>
    </form>
</body>

</html>