<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href = "css/main.css" rel = "stylesheet">
    <title>Sign up</title>
</head>
<body>
    <div id = "main-text-container">
        <form id = "main-form" method = "POST" action = "scripts/php/reg.php">
            <input type = "text" placeholder = "Введите логин." name = "username">
            <input type = "password" placeholder = "Введите пароль." name = "password">
            <input type = "submit" value = "регистрация">
        </form>
    </div>
</body>
</html>