<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_dish'])) {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $weight = $_POST['weight'];

        $stmt = $conn->prepare("INSERT INTO products (name, category, price, img, weight, added_by_admin) VALUES (?, ?, ?, ?, ?, 1)");
        $stmt->bind_param("ssiss", $name, $category, $price, $img, $weight);

        if ($stmt->execute()) {
            $success = "Блюдо успішно додано!";
        } else {
            $error = "Помилка додавання блюда.";
        }
    } elseif (isset($_POST['edit_dish'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $weight = $_POST['weight'];

        $stmt = $conn->prepare("UPDATE products SET name = ?, category = ?, price = ?, img = ?, weight = ? WHERE id = ?");
        $stmt->bind_param("ssissi", $name, $category, $price, $img, $weight, $id);

        if ($stmt->execute()) {
            $success = "Блюдо успішно оновлено!";
        } else {
            $error = "Помилка оновлення блюда.";
        }
    } elseif (isset($_POST['delete_dish'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $success = "Блюдо успішно видалено!";
        } else {
            $error = "Помилка видалення блюда.";
        }
    }
}

$dishes = [];
$stmt = $conn->prepare("SELECT * FROM products WHERE added_by_admin = 1");
$stmt->execute();
$result = $stmt->get_result();
while ($dish = $result->fetch_assoc()) {
    $dishes[] = $dish;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Dishes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Dishes</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" name="category" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="img">Image URL</label>
                    <input type="text" class="form-control" name="img" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" name="weight" required>
                </div>
            </div>
            <button type="submit" name="add_dish" class="btn btn-primary">Add Dish</button>
        </form>

        <h2>Existing Dishes</h2>
        <?php foreach ($dishes as $dish): ?>
            <form method="POST" class="mb-4">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($dish['id']); ?>">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($dish['name']); ?>" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($dish['category']); ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" value="<?php echo htmlspecialchars($dish['price']); ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="img">Image URL</label>
                        <input type="text" class="form-control" name="img" value="<?php echo htmlspecialchars($dish['img']); ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" name="weight" value="<?php echo htmlspecialchars($dish['weight']); ?>" required>
                    </div>
                </div>
                <button type="submit" name="edit_dish" class="btn btn-success">Edit Dish</button>
                <button type="submit" name="delete_dish" class="btn btn-danger">Delete Dish</button>
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>
