<?php
session_start();
if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}
?>

<?php
require 'db.php'; // Підключення до бази даних
$ordersQuery = "SELECT * FROM orders";
$ordersResult = $conn->query($ordersQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Адмін-панель - SushiSloth</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .header {
            margin-bottom: 70px;
        }
        .main {
            padding-top: 70px;
        }
        h1 {
            margin-bottom: 30px;
        }
        .admin-menu {
            list-style: none;
            padding: 0;
        }
        .admin-menu li {
            margin-bottom: 10px;
        }
        .admin-menu a {
            text-decoration: none;
            font-weight: 500;
            color: #fff;
            background-color: #343a40;
            padding: 10px 15px;
            border-radius: 5px;
            display: block;
        }
        .admin-menu a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="./pics/SushiSloth.png" alt="Logo" height="30"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="order.php" data-lang="order">Моє замовлення</a></li>
                        <li class="nav-item"><a class="nav-link" href="news.php" data-lang="news">Новини</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php" data-lang="home">Головна</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php" data-lang="about">Про нас</a></li>
                        <li class="nav-item"><a class="nav-link" href="help.php" data-lang="help">Допомога</a></li>
                    </ul>
                    <div class="dropdown ml-auto">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            UA
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="#" onclick="setLanguage('UA')">UA</a>
                            <a class="dropdown-item" href="#" onclick="setLanguage('EN')">EN</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="main">
        <div class="container">
            <h1>Адмін Меню</h1>
            <ul class="admin-menu">
                <li><a href="manage_dishes.php">Управління стравами</a></li>
                <li><a href="manage_orders.php">Управління замовленнями</a></li>
                <li><a href="add_admin.php">Додати адміністратора</a></li>
            </ul>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
