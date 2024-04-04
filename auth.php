<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./styles/auth.css" />
    <script src="https://kit.fontawesome.com/34d37fffb3.js"></script>

    <title>Auth</title>
</head>

<body>
    <div class="main-div">
        <form action="auth-db.php" method="post" class="form-control">
            <h1 style="text-align: center">Авторизация</h1>
            <div class="first-element">
                <label for="email">Почта: </label>
                <input type="email" name="email" id="email" />
            </div>
            <div class="second-element">
                <label for="password">Пароль: </label>
                <input type="password" name="password" id="password" />
            </div>
            <button type="submit" class="btn">Войти</button>
            <a href="./reg.php" style="align-self: end">Регистрация...</a>
        </form>
    </div>
</body>

</html>