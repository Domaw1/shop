<?php require_once "connection.php";

$itemId = $_GET['item'];

$removeItemFromCart = $conn->prepare("DELETE FROM cart WHERE id = ?");
$removeItemFromCart->bind_param('i', $itemId);
$removeItemFromCart->execute();

echo "<script>alert('Товар удален!');
            window.location='cart.php'</script>";
