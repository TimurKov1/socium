<?php
    session_start();
    if(isset($_SESSION['user'])){
        header('Location:profile.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>SOCIUM</title>
</head>
<body>
    <main class="main">
        <img class="main__logo" src="./images/purple_logo.svg" alt="">
        <div class="buttons main__buttons">
            <button class="button button_blue login-button">Вход</button>
            <button class="button button_white registration-button">Регистрация</button>
        </div>
        <form class="form main__form login-form show">
            <input class="input" type="email" name="email" placeholder="e-mail">
            <input class="input" type="password" name="password" placeholder="пароль">
            <button class="button button_purple form__button logIn">Войти</button>
            <div class="error_msg"></div>
        </form>
        <form class="form main__form registration-form hide" enctype="multipart/form-data">
            <input class="input" type="text" name="name" placeholder="имя">
            <input class="input" type="text" name="surname" placeholder="фамилия">
            <label for="photo">
                Аватар
                <input type="file" name="photo" id="photo">
            </label>
            <input class="input" type="email" name="email" placeholder="e-mail">
            <input class="input" type="password" name="password" placeholder="пароль">
            <button class="button button_purple form__button registration">Зарегестрироваться</button>
            <div class="error_msg"></div>
        </form>
    </main>
    <script src="js/functions.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/authentication.js"></script>
</body>
</html>