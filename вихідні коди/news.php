<?php
session_start();
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
require 'db.php';

// Fetch dishes from the database
$dishes = [];
$categories = [];
$stmt = $conn->prepare("SELECT * FROM products WHERE added_by_admin = 1");
$stmt->execute();
$result = $stmt->get_result();
while ($dish = $result->fetch_assoc()) {
    $dishes[] = $dish;
    if (!in_array($dish['category'], $categories)) {
        $categories[] = $dish['category'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="language.js"></script>
    <title>SushiSloth - Новини</title>
    <link rel="icon" href="pics/logo1.png">

</head>
<body>
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                    <li class="nav-item"><a class="nav-link" href="help.php" data-lang="help">Допомога</a></li>
                </ul>
                <div class="tooltipmenu">
                <?php if (isset($_SESSION['username'])): ?>
                    <?php if ($is_admin): ?>
                        <button class="setting-btn" onclick="redirectToAdmin()">
                            <span class="bar bar1"></span>
                            <span class="bar bar2"></span>
                            <span class="bar bar3"></span>
                        </button>
                        <script>
                            function redirectToAdmin() {
                                window.location.href = 'admin.php';
                            }
                        </script>
                    <?php endif; ?>
                    <button class="Btn-login" onclick="logOutBtn()">  
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text">Вихід</div>
                    </button>
                    <script>
                        function logOutBtn() {
                            window.location.href = 'logout.php';
                        }
                    </script>
                <?php else: ?>
                    <button class="Btn-login" onclick="window.location.href='login.php'">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text">Вхід</div>
                    </button>
                <?php endif; ?>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="languageDropdown" aria-haspopup="true" aria-expanded="false">
                        UA &nbsp;
                    </button>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="#" onclick="setLanguage('UA'); return false;">UA</a>
                        <a class="dropdown-item" href="#" onclick="setLanguage('EN'); return false;">EN</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </nav>
</header>

    <main class="main">
        <div class="container mt-5 pt-5">
            <h1 class="display-4" data-lang="latest-news">Останні новини</h1>
            <div class="news-container">
                <div class="news-item">
                    <img src="pics/about/photo1.jpg" alt="Новий шеф-кухар" class="img-fluid">
                    <h2 class="news-title" data-lang="news-title-1">Приєднуйтеся до нас на святкування запуску нових страв</h2>
                    <p class="news-date">16 травня 2024</p>
                    <p class="news-content" data-lang="news-content-1">Ми раді представити вам нові смачні страви, які створив наш новий шеф-кухар! Приєднуйтеся до нас на святковий захід з дегустацією, де ви зможете насолодитися нашими новинками.</p>
                </div>
                <div class="news-item">
                    <img src="pics/about/photo2.jpg" alt="Акція" class="img-fluid">
                    <h2 class="news-title" data-lang="news-title-2">Спеціальна акція до Дня Києва</h2>
                    <p class="news-date">20 травня 2024</p>
                    <p class="news-content" data-lang="news-content-2">До Дня Києва ми підготували для вас спеціальні пропозиції та знижки! Замовляйте ваші улюблені суші та отримуйте бонусні страви у подарунок. Святкуйте разом з SushiSloth!</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer bg-dark text-white mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-col">
                <h4 data-lang="navigation">НАВІГАЦІЯ</h4>
                <ul>
                    <li><a href="order.php" data-lang="order">Моє замовлення</a></li>
                    <li><a href="news.php" data-lang="news">Новини</a></li>
                    <li><a href="index.php" data-lang="home">Головна</a></li>
                    <li><a href="help.php" data-lang="help">Допомога</a></li>
                </ul>
            </div>
            <div class="col-md-4 footer-col">
                <h4 data-lang="social">Соц. мережі</h4>
                <div class="social-links">
                    <a href="404.html"><i class="fab fa-facebook-f"></i></a>
                    <a href="404.html"><i class="fab fa-instagram"></i></a>
                    <a href="404.html"><i class="fab fa-telegram"></i></a>
                </div>
            </div>
            <div class="col-md-4 footer-col">
                <h4 data-lang="contacts">Контакти</h4>
                <p data-lang="phone">Телефон: +38 012 345 6789</p>
                <p>Email: info@sushisloth.ua</p>
                <p data-lang="address">Адреса: вул. Суші, 1, Київ, Україна</p>
            </div>
        </div>
        <hr size="1px" class="bg-light">
        <div class="down d-flex justify-content-between align-items-center">
            <p>© 2024 SushiSloth Ліцензія № 22 від 19.03.2020</p>
        </div>
    </div>
</footer>
</body>
</html>
