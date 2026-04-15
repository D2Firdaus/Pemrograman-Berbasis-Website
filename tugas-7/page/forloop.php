<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Soal 2</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/page.css">
</head>

<body>
    <h1>Pengecekan bilangan genap dengan for loop
    </h1>
    <?php include "../include/navbar.php"; ?>

    <form action="" method="post">
        <label for="maksangka">Batas atas :</label>
        <input type="text" name="maksangka">
        <input type="submit" name="submit" value="Submit">
        <?php
        echo "<br>";

        if (!empty($_POST['maksangka'])) {
            $maksangka = $_POST['maksangka'];
            if (isset($_POST['submit'])) {
                echo "<br>";
                echo "<span style='color: var(--secondary-color); font-weight: 500;'>";
                for ($i = 0; $i <= $maksangka; $i++) {
                    if ($i % 2 == 0) {
                        echo "$i ";
                    }
                }
            }
        }
        ?>
    </form>
</body>

</html>