<?php require_once "connection.php";

$currentEmail = $_SESSION["user_email"];

$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$password = trim($_POST["password"]);

$insert_query = $conn->prepare("UPDATE `users` set email = ?, phone = ?, password = ? WHERE email = ?");

$insert_query->bind_param("ssss", $email, $phone, $password, $currentEmail);
$result = $insert_query->execute();

if($result) {
    $_SESSION["user_email"] = $email;
    echo "<script>alert('Профиль изменен!');
    window.location='profile.php'</script>";
} else {
    echo "<script>alert('Ошибка!');</script>";
}