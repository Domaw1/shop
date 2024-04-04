<?php require_once "connection.php";;
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$password = trim($_POST["password"]);

$select_query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$select_query->bind_param("s", $email);
$select_query->execute();
$select_query = $select_query->get_result();

if ($select_query->num_rows > 0) {
    echo "<script>alert('Данная почта уже используется!');
        window.location='reg.php'</script>";
    exit;
}
$insert_query = $conn->prepare("INSERT INTO `users` (email, phone, password) VALUES (?, ?, ?)");

$insert_query->bind_param("sss", $email, $phone, $password);
$result = $insert_query->execute();

if($result) {
    $_SESSION["user_email"] = $email;
    echo "<script>alert('Добро пожаловать!');
    window.location='index.php'</script>";
} else {
    echo "<script>alert('Ошибка!');</script>";
}

$insert_query->close();
$select_query->close();