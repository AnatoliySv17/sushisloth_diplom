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
    <title>SushiSloth</title>
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
    <div class="social">
        <ul class="wrapper">
            <li class="icon facebook" onclick="window.location.href='404.html'">
                <span class="tooltip">Facebook</span>
                <svg viewBox="0 0 320 512" height="1.2em" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                </svg>
            </li>
            <li class="icon telegram" onclick="window.location.href='404.html'">
                <span class="tooltip">Telegram</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0,50) scale(0.1,-0.1)" fill="#000000" stroke="none">
                        <path d="M170 397 c-102 -54 -119 -189 -34 -269 56 -52 120 -61 188 -28 100 48 126 174 53 257 -58 66 -132 80 -207 40z m143 -1 c103 -43 128 -177 48 -257 -112 -113 -296 -12 -267 146 18 94 128 150 219 111z"/>
                        <path d="M235 285 c-44 -18 -81 -38 -83 -44 -7 -21 54 -11 93 15 l40 27 -27 -30 c-16 -16 -28 -34 -28 -39 0 -10 52 -44 68 -44 11 0 34 132 24 141 -4 4 -43 -8 -87 -26z"/>
                    </g>
                </svg>
            </li>
            <li class="icon instagram" onclick="window.location.href='404.html'">
                <span class="tooltip">Instagram</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                </svg>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="main2">
            <div class="carousel">
                <img src="pics/main/carousel/1111.png" alt="Image 1">
                <img src="pics/main/carousel/1112.png" alt="Image 2">
                <img src="pics/main/carousel/1113.png" alt="Image 3">
                <script>
                    const images = document.querySelectorAll('.carousel img');
                    let currentIndex = 0;

                    function showNextImage() {
                        images[currentIndex].style.display = 'none';
                        currentIndex = (currentIndex + 1) % images.length;
                        images[currentIndex].style.display = 'block';
                    }

                    setInterval(showNextImage, 3000);
                </script>
            </div>
        </div>
    <div class="container" id="catalog">
        <div class="row">
            <div class="col-md-9">
                <div class="filter mb-4">
                    <select class="form-control" id="filter-category">
                        <option value="all" data-lang="all">Все</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category); ?>" data-lang="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-control" id="sort-price">
                        <option value="none" data-lang="sort">Ціна</option>
                        <option value="asc" data-lang="asc">Від дешевих до дорогих</option>
                        <option value="desc" data-lang="desc">Від дорогих до дешевих</option>
                    </select>
                </div>
                <div class="row products">
                    <?php foreach ($dishes as $dish): ?>
                        <div class="col-md-4 mb-4 product-card" data-category="<?php echo htmlspecialchars($dish['category']); ?>" data-id="<?php echo htmlspecialchars($dish['id']); ?>">
                            <img src="<?php echo htmlspecialchars($dish['img']); ?>" alt="<?php echo htmlspecialchars($dish['name']); ?>" class="img-fluid">
                            <h3><?php echo htmlspecialchars($dish['name']); ?></h3>
                            <p data-lang="category">Категорія: <?php echo htmlspecialchars($dish['category']); ?></p>
                            <p data-lang="weight">Вага: <?php echo htmlspecialchars($dish['weight']); ?></p>
                            <p class="price"><?php echo htmlspecialchars($dish['price']); ?> грн</p>
                            <button class="btn btn-primary add-to-cart" data-lang="add-to-cart">Додати до кошика</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center">
                    <button id="load-more" class="btn btn-primary" data-lang="load-more">Більше</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cart sticky-top">
                    <h2 data-lang="cart">Корзина</h2>
                    <ul id="cart-items" class="list-group">
                    </ul>
                    <div class="cart-total mt-3">
                        <strong data-lang="total">Всього:</strong> <span id="cart-total-price">0</span> грн
                    </div>
                    <button id="checkout" class="btn btn-success mt-3" data-lang="checkout" onclick="checkOut()">Замовити</button>
                    <script>
                        function checkOut() {
                            window.location.href = 'order.php';
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const products = <?php echo json_encode($dishes); ?>;
        localStorage.setItem('products', JSON.stringify(products));
    });
    </script>
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
