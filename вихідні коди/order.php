<?php
session_start();
require 'db.php';
require 'vendor/liqpay/liqpay/LiqPay.php';

$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch additional products for the carousel
$additionalProducts = [];
$stmt = $conn->prepare("SELECT * FROM products WHERE added_by_admin = 1 ORDER BY RAND() LIMIT 5");
$stmt->execute();
$result = $stmt->get_result();
while ($product = $result->fetch_assoc()) {
    $additionalProducts[] = $product;
}

// LiqPay credentials
$config = include('config.php');
$liqpayPublicKey = $config['public_key'];
$liqpayPrivateKey = $config['private_key'];

$liqpay = new LiqPay($liqpayPublicKey, $liqpayPrivateKey);

// Retrieve the cart from session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalAmount = array_reduce($cart, function($sum, $item) {
    return $sum + $item['price'] * $item['quantity'];
}, 0); // Add delivery fee

$totalAmount += 59; // Add delivery fee

$params = [
    'action' => 'pay',
    'amount' => round($totalAmount, 2),
    'currency' => 'UAH',
    'description' => 'Оплата замовлення',
    'order_id' => 'order_' . time(),
    'version' => '3',
    'sandbox' => 1 // Заберіть цей рядок для робочого середовища
];

// Генерація форми LiqPay
$liqpayForm = $liqpay->cnb_form($params);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="order.css">
    <title>SushiSloth - Моє замовлення</title>
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
                    <li class="nav-item"><a class="nav-link" href="order.php" data-lang="order">Моє замовлення</a></ли>
                    <li class="nav-item"><a class="nav-link" href="news.php" data-lang="news">Новини</a></ли>
                    <li class="nav-item"><a class="nav-link" href="index.php" data-lang="home">Головна</a></ли>
                    <li class="nav-item"><a class="nav-link" href="help.php" data-lang="help">Допомога</a></ли>
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
        <h1 class="display-4" data-lang="your-order">Ваше замовлення</h1>
        <div class="row">
            <div class="col-md-8 order-details">
                <p data-lang="total-products">Загальна кількість продуктів у вашому кошику: <span id="total-products-count">0</span></p>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col" data-lang="quantity">Кількість</th>
                            <th scope="col" data-lang="product">Продукт</th>
                            <th scope="col" data-lang="price">Ціна</th>
                        </tr>
                    </thead>
                    <tbody id="order-items">
                        <!-- Items will be added dynamically here -->
                    </tbody>
                </table>
                <div class="total-amount">
                    <p class="font-weight-bold" data-lang="total-amount">Загальна сума:</p>
                    <p id="total-amount" class="font-weight-bold"><?php echo $totalAmount; ?> грн</p>
                </div>
                <div class="additional-products mb-4">
                    <h4 data-lang="additional-products">Бажаєте ще щось?</h4>
                    <div id="additional-products-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Additional products will be dynamically added here -->
                            <?php if (!empty($additionalProducts)): ?>
                                <?php foreach ($additionalProducts as $index => $product): ?>
                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <div class="additional-product card m-2">
                                            <div class="card-body">
                                                <div><img src="<?php echo htmlspecialchars($product['img']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>"></div>
                                                <div> <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                                <p class="card-text"><?php echo htmlspecialchars($product['price']); ?> грн</p>
                                                <button class="btn btn-primary" onclick="addToOrder('<?php echo htmlspecialchars($product['name']); ?>', <?php echo htmlspecialchars($product['price']); ?>, '<?php echo htmlspecialchars($product['img']); ?>')">Додати в замовлення</button></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No additional products available</p>
                            <?php endif; ?>
                        </div>
                        <a class="carousel-control-prev" href="#additional-products-carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#additional-products-carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>                    
                <form id="order-form">
                    <div class="contact-information mb-4">
                        <h4 data-lang="contact-information">Контактна інформація</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName" data-lang="first-name">Ім'я*</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="surname" data-lang="surname">Прізвище*</label>
                                <input type="text" class="form-control" id="surname" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telephone" data-lang="telephone">Телефон*</label>
                                <input type="text" class="form-control" id="telephone" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" data-lang="email">Електронна пошта*</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="delivery-address mb-4">
                        <h4 data-lang="delivery-address">Адреса доставки</h4>
                        <div class="form-group">
                            <label for="address" data-lang="address">Адреса*</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="form-group">
                            <label for="address-specification" data-lang="address-specification">Додатково до адреси</label>
                            <input type="text" class="form-control" id="address-specification">
                        </div>
                    </div>
                    <div class="payment-type mb-4">
                        <h4 data-lang="payment-type">Спосіб оплати</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentType" id="cash" value="cash" checked>
                            <label class="form-check-label" for="cash" data-lang="cash">Готівка</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentType" id="cardOnline" value="card">
                            <label class="form-check-label" for="cardOnline" data-lang="card-online">Картка онлайн</label>
                        </div>
                    </div>
                    <div class="terms mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ageConfirmation" required>
                            <label class="form-check-label" for="ageConfirmation" data-lang="age-confirmation">Мені виповнилося 16 років</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="termsAcceptance" required>
                            <label class="form-check-label" for="termsAcceptance" data-lang="terms-acceptance">Я погоджуюся з умовами та положеннями ... і обробкою персональних даних</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" id="pay-button" data-lang="pay-online" disabled>Оплатити при доставці</button>
                </form>
                <div id="liqpay-form-container" style="display:none;">
                    <form method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">
                        <?php echo $liqpayForm; ?>
                    </form>
                </div>
            </div>
            <div class="col-md-4 restaurant-info">
                <div class="restaurant-card bg-dark text-white p-3">
                    <img src="pics/logo1.png" alt="Restaurant Logo" class="img-fluid mb-3">
                    <h3>SushiSloth</h3>
                    <p>Slowly, Enjoy the Taste</p>
                    <p data-lang="minimum">Мінімум: 50 грн</p>
                    <p data-lang="delivery-free">Доставка: 59 грн</p>
                    <p data-lang="delivery-time">Час доставки: 35 - 45 хв.</p>
                </div>
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
                    <li><a href="order.php" data-lang="order">Моє замовлення</a></ли>
                    <li><a href="news.php" data-lang="news">Новини</a></ли>
                    <li><a href="index.php" data-lang="home">Головна</a></ли>
                    <li><a href="about.php" data-lang="about">Про нас</а></ли>
                    <ли><а href="help.php" data-lang="help">Допомога</a></ли>
                    <ли><а href="admin.php" data-lang="staff">Для персоналу</а></ли>
                </ул>
            </div>
            <div class="col-md-4 footer-col">
                <h4 data-lang="social">Соц. мережі</h4>
                <div class="social-links">
                    <a href="404.php"><i class="fab fa-facebook-f"></i></a>
                    <a href="404.php"><i class="fab fa-instagram"></i></a>
                    <a href="404.php"><i class="fab fa-telegram"></i></a>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="order.js"></script>
<script src="language.js"></script>
<script>

</script>
</body>
</html>
