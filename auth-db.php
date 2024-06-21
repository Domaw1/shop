<?php require "connection.php";

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

$selectQuery = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$selectQuery->bind_param("ss", $email, $password);
$selectQuery->execute();
$selectQuery = $selectQuery->get_result();

if ($selectQuery->num_rows > 0) {
    $_SESSION["user_email"] = $selectQuery->fetch_assoc()["email"];
    echo "<script>alert('Добро пожаловать!');
        window.location='index.php'</script>";
} else {
    echo "<script>alert('Пользователь не найден');
      window.location='auth.php'</script>";
}
