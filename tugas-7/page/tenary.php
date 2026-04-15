<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Soal 4</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/page.css">
</head>

<body>
    <h1>Pengecekan bilangan genap dengan for loop
    </h1>
    <?php include "../include/navbar.php"; ?>

    <form action="" method="post">
        <label for="maksangka">Masukkan angka :</label>
        <input type="number" name="isevenorodd">
        <input type="submit" name="submit" value="Submit">
        <?php
        echo "<br>";
        if (!empty($_POST['isevenorodd'])) {
            $isevenorodd = $_POST['isevenorodd'];
            if (!empty($_POST['submit'])) {
                echo "<span style='color: var(--secondary-color); font-weight: 500;'>";
                $whatisit = (($isevenorodd % 2) == 0) ? "even" : "odd";
                echo "<br>";
                echo $whatisit;
            }
        }
        ?>
    </form>
</body>

</html>