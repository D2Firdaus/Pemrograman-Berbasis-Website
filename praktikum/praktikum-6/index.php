<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="get">
        <label for="input-name">Nama:
            <input type="text" name="input-name" placeholder="Enter your name"></label>
        <br>
        <label for="input-umur">Umur:
            <input type="number" name="input-umur" placeholder="Enter your age"></label>
        <br>
        <label for="is-ktp">KTP:
            <label for="is-ktp-yes">
                <input type="radio" id="is-ktp-yes" name="is-ktp" value="yes">Ada</label>
            <label for="is-ktp-no">
                <input type="radio" id="is-ktp-no" name="is-ktp" value="no">Tidak</label>
            <br>
        </label>
        <input type="submit">
        <br>
        <br>
        <?php
        if (isset($_GET['input-name']) && isset($_GET['input-umur']) && isset($_GET['is-ktp'])) {
            $name = $_GET['input-name'];
            $umur = $_GET['input-umur'];
            $is_ktp = $_GET['is-ktp'];

            if ($umur >= 17 && $is_ktp === 'yes') {
                echo $name . " kamu boleh memilih Jokowi, Hidup Jokowi!";
            } else {
                echo "Maaf, " . $name . " pilih aja Netanyahu.";
            }
        }
        ?>
    </form>
</body>

</html>