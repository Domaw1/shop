<?php require_once "connection.php";
$currentUser = $_SESSION["user_email"];

$selectQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
$selectQuery->bind_param('s', $currentUser);
$selectQuery->execute();
$userId = $selectQuery->get_result()->fetch_assoc()["id"];

$selectQuery = $conn->prepare("SELECT * FROM cart INNER JOIN products on cart.product_id = products.id WHERE cart.user_id = ? ORDER BY cart.id ");
$selectQuery->bind_param('i', $userId);
$selectQuery->execute();
$userCart = $selectQuery->get_result()->fetch_all();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/main.css" />
    <script src="https://kit.fontawesome.com/34d37fffb3.js"></script>
    <title>Cart</title>
</head>

<body>
    <header>
        <?php require "navbar.php" ?>
    </header>
    <div class="user-cart">
        <?php foreach ($userCart as $product): ?>
            <div class="items">
                <p style="font-size: 25px;"><?= $product[4] ?>  </p>
                <p style="font-size: 25px;"><?= $product[11] ?>₽</p>
                <a href="remove-item.php?item=<?= $product[0]?>" style="font-size: 25px;">Удалить</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>