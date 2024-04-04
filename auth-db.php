<?php require "connection.php";

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

$select_query = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$select_query->bind_param("ss", $email, $password);
$select_query->execute();
$select_query = $select_query->get_result();

if ($select_query->num_rows > 0) {
    $_SESSION["user_email"] = $select_query->fetch_assoc()["email"];
    echo "<script>alert('Добро пожаловать!');
        window.location='index.php'</script>";
} else {
    echo "<script>alert('Пользователь не найден');
        window.location='auth.php'</script>";
}

$select_query->close();