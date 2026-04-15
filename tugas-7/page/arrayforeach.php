<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Soal 3</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/page.css">
</head>

<body>
    <h1>Print array menggunakan for loop</h1>
    <?php include "../include/navbar.php"; ?>


    <?php
    $data_lama = isset($_POST['history_data']) ? $_POST['history_data'] : "";
    if (isset($_POST['namahewan']) && $_POST['namahewan'] !== "") {
        $input_baru = $_POST['namahewan'];
        if ($data_lama === "") {
            $data_lama = $input_baru;
        } else {
            $data_lama .= "|" . $input_baru;
        }
    }

    $array_hewan = ($data_lama !== "") ? explode("|", $data_lama) : [];
    ?>

    <form method="post">
        <label for="namahewan">Masukkan nama hewan :</label>
        <input type="text" name="namahewan">

        <input type="hidden" name="history_data" value="<?php echo htmlspecialchars($data_lama); ?>">

        <input type="submit" value="Submit">
        <br> <br>
        <?php
        $no = 1;
        foreach ($array_hewan as $hewan) {
            echo "<span style='color: var(--secondary-color); font-weight: 500;'>";
            echo $no . ". " . htmlspecialchars($hewan) . "<br>";
            $no++;
        }
        ?>
    </form>


</body>

</html>