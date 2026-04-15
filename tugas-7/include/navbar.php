<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");

        :root {
            --primary-color: #214656;
            --secondary-color: #e0fc4c;
            --background-color: #d3d3d3;
            --font-family: "Roboto", sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--primary-color);
            display: flex;
            width: 100%;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--secondary-color);
            border-top: 1px solid var(--secondary-color);
        }

        .navbar a {
            display: block;
            padding: 15px 20px;
            color: var(--secondary-color);
            text-decoration: none;
            font-family: sans-serif;
        }

        .navbar a:hover {
            background-color: #1a3744;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="/pemrograman-berbasis-website/tugas-7/index.php">Home</a>
        <a href="/pemrograman-berbasis-website/tugas-7/page/switch.php">Vehicle Checker</a>
        <a href="/pemrograman-berbasis-website/tugas-7/page/forloop.php">Even Numbers Printer</a>
        <a href="/pemrograman-berbasis-website/tugas-7/page/arrayforeach.php">Input to Print Animal List</a>
        <a href="/pemrograman-berbasis-website/tugas-7/page/tenary.php">Even or Odd Checker</a>
    </div>
</body>

</html>