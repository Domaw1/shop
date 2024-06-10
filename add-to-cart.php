<?php require_once "connection.php";

$currentUser = $_SESSION['user_email'];
$itemId = $_GET['item'];

$selectQueryUser = $conn->prepare("SELECT * FROM users WHERE email = ?");
$selectQueryUser->bind_param('s', $currentUser);
$selectQueryUser->execute();
$userId = $selectQueryUser->get_result()->fetch_assoc()["id"];

$selectQuery = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$selectQuery->bind_param('i', $userId);
$selectQuery->execute();
$cart = $selectQuery->get_result()->fetch_all();

foreach ($cart as $item) {
    if ($item[2] == $itemId) {
        echo "<script>alert('Товар уже в корзине!');
            window.location='index.php'</script>";
        return;
    }
}

$insertQuery = $conn->prepare("INSERT INTO `cart` (user_id, product_id) VALUES (?, ?)");
$insertQuery->bind_param('is', $userId, $itemId);
$insertQuery->execute();
$insertQuery->get_result();

if ($insertQuery) {
    echo "<script>alert('Товар добавлен!');
        window.location='index.php'</script>";
} else {
    echo "<script>alert('Ошибка');
        window.location='index.php'</script>";
}
