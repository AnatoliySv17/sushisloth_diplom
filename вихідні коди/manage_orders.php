<?php
session_start();
require 'db.php';

// Check if user is admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied.";
    exit();
}

// Fetch orders from the database
$orders = [];
$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$result = $stmt->get_result();
while ($order = $result->fetch_assoc()) {
    $orders[] = $order;
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
    <title>Admin Dashboard - Manage Orders</title>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="./pics/SushiSloth.png" alt="Logo" height="30"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Головна</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_orders.php">Управління замовленнями</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Вихід</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="main">
        <div class="container mt-5 pt-5">
            <h1 class="display-4">Управління замовленнями</h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Користувач</th>
                        <th scope="col">Ім'я</th>
                        <th scope="col">Прізвище</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Email</th>
                        <th scope="col">Адреса</th>
                        <th scope="col">Спосіб оплати</th>
                        <th scope="col">Загальна сума</th>
                        <th scope="col">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['username']); ?></td>
                            <td><?php echo htmlspecialchars($order['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['surname']); ?></td>
                            <td><?php echo htmlspecialchars($order['telephone']); ?></td>
                            <td><?php echo htmlspecialchars($order['email']); ?></td>
                            <td><?php echo htmlspecialchars($order['address']); ?></td>
                            <td><?php echo htmlspecialchars($order['payment_type']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_amount']); ?> грн</td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="footer bg-dark text-white mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <h4>НАВІГАЦІЯ</h4>
                    <ul>
                        <li><a href="order.php">Моє замовлення</a></li>
                        <li><a href="news.php">Новини</a></li>
                        <li><a href="index.php">Головна</a></li>
                        <li><a href="about.php">Про нас</a></li>
                        <li><a href="help.php">Допомога</a></li>
                        <li><a href="admin.php">Для персоналу</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-col">
                    <h4>Соц. мережі</h4>
                    <div class="social-links">
                        <a href="404.php"><i class="fab fa-facebook-f"></i></a>
                        <a href="404.php"><i class="fab fa-instagram"></i></a>
                        <a href="404.php"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <h4>Контакти</h4>
                    <p>Телефон: +38 012 345 6789</p>
                    <p>Email: info@sushisloth.ua</p>
                    <p>Адреса: вул. Суші, 1, Київ, Україна</p>
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
