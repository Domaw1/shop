<?php require_once "connection.php";
$email = $_SESSION["user_email"] ?? null;

$select_query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$select_query->bind_param("s", $email);
$select_query->execute();
$select_query = $select_query->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./styles/main.css" />
  <script src="https://kit.fontawesome.com/34d37fffb3.js"></script>
  <title>Profile</title>
</head>

<body>
  <div class="profile">
    <h1 style="margin-bottom: 30px;">Профиль</h1>
    <form class="user-profile" action="update-profile.php" method="post">
      <input type="text" name="email" required value="<?= $select_query["email"] ?>">
      <input type="text" name="phone" pattern="[8]{1} [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}" value="<?= $select_query["phone"] ?>" required>
      <p>Формат: 8 123 456-78-90</p>
      <input type="text" name="password" value="<?= $select_query["password"] ?>" required minlength="5">
      <button type="submit" class="btn">Изменить профиль</button>
      <a href="logout.php">Выйти</a>
      <a href="index.php">Вернуться</a>
    </form>
  </div>
</body>

</html>