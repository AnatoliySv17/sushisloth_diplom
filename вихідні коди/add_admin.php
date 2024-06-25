<?php
session_start();
if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

require 'db.php';

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (empty($username) || empty($password) || empty($email)) {
        $errorMessage = "Всі поля обов'язкові.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Користувач з таким іменем або email вже існує.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, is_admin) VALUES (?, ?, ?, 1)");
            $stmt->bind_param("sss", $username, $hashedPassword, $email);

            if ($stmt->execute()) {
                $successMessage = "Адміністратор успішно доданий.";
            } else {
                $errorMessage = "Помилка при додаванні адміністратора.";
            }
        }
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
    <title>Додати адміністратора - SushiSloth</title>
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
        .container {
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 0;
        }
        .btn {
            border-radius: 0;
            background-color: #343a40;
            color: #fff;
        }
        .btn:hover {
            background-color: #495057;
        }
        .alert {
            border-radius: 0;
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
        <div class="container mt-5 pt-5">
            <h1>Додати адміністратора</h1>
            <?php if ($successMessage): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Ім'я користувача</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-dark">Додати адміністратора</button>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
