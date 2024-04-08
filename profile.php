<?php require_once "connection.php";
$currentUser = $_SESSION["user_email"] ?? null;
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
    <h1>PROFILE</h1>
    <a href="logout.php">Выйти</a>
  </body>
</html>
