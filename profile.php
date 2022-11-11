<?php
    session_start();
    include('php/connect.php');
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <header class="header">
        <img class="header__logo" src="./images/white_logo.svg" alt="Логотип">
        <a href="php/exit.php">Выход</a>
        <img class="header__user" src="./images/default_user.svg" alt="Личный кабинет">
    </header>
    <main class="main profile-main">
        <div class="user-info main__user-info">
            <img class="user-info__logo" src="/user_materials/<?php echo $_SESSION['user']['email'].'/'.$_SESSION['user']['photo'];?>" alt="Фото пользователя">
            <h3 class="text user-info__name"><?php echo $_SESSION['user']['name']; ?></h3>
            <h2 class="text user-info__surname"><?php echo $_SESSION['user']['surname']; ?></h2>
            <h4 class="text user-info__email"><?php echo $_SESSION['user']['email']; ?></h4>
        </div>
        <nav class="nav">
            <h3 class="text nav__item active">Подписки</h3>
            <h3 class="text nav__item">Посты</h3>
            <h3 class="text nav__item">Настройки</h3>
        </nav>
        <ul class="main__block subscriptions main__subscriptions">
            <?php
                $query = "SELECT * FROM `subscriptions` WHERE `id_subject` = ".$_SESSION['user']['id'];
                $res = mysqli_query($conn,$query);
                $subscriptions = [];
                while($row =mysqli_fetch_assoc($res)){
                    $q = "SELECT `name`, `surname` FROM `users` WHERE `id` = ".$row['id_object'];
                    $r = mysqli_fetch_assoc(mysqli_query($conn,$q));
                    $subscriptions[] = $row + $r;
                    echo '<li class="subscription-item">
                            <img class="subscriptions__logo" src="./images/lk.svg" alt="">
                            <h3 class="text subscriptions__name">'.$r['name'].' '.$r['surname'].'</h3>
                        </li>';
                }
                
            ?>
        </ul>
        <div class="main__block posts hide">
            <button class="button button_blue posts__button">Добавить пост</button>
            <ul class="posts__body">
                <?php
                    $query = "SELECT * FROM `posts` WHERE `id_user` = ".$_SESSION['user']['id'];
                    $res = mysqli_query($conn,$query);
                    while($row =mysqli_fetch_assoc($res)){
                        echo '<li class="post">';
                                
                        //фото
                        $q = "SELECT `path` FROM `photo` WHERE `id_post` = ".$row['id'];
                        $r = mysqli_query($conn,$q);
                        while ($row1 = mysqli_fetch_assoc($r)){
                            echo '<img class="post__img" src="/user_materials/ivan2@mail.ru/'.$row1['path'].'" alt="Фотгография поста">';
                        }
                        //видео
                        $q = "SELECT `path` FROM `video` WHERE `id_post` = ".$row['id'];
                        $r = mysqli_query($conn,$q);
                        while ($row1 = mysqli_fetch_assoc($r)){
                            
                        }

                        echo '<p class="text post__text">'.$row['text'].'</p>';

                        //файлы
                        $q = "SELECT `path` FROM `files` WHERE `id_post` = ".$row['id'];
                        $r = mysqli_query($conn,$q);
                        while ($row1 = mysqli_fetch_assoc($r)){
                           echo "<a href='user_materials/".$_SESSION['user']['email']."/".$row1['path']."' download>".$row1['path']."</a>";
                        }

                        echo '</li>';
                    }
                ?>
                <li class="post">
                    <img class="post__img" src="/user_materials/ivan2@mail.ru/post-img.png" alt="Фотгография поста">
                    <p class="text post__text">Не следует, однако забывать, что начало повседневной работы по формированию позиции требуют от нас анализа форм развития. Задача организации, в особенности же дальнейшее развитие различных форм деятельности представляет собой интересный эксперимент проверки направлений прогрессивного развития. Равным образом рамки и место обучения кадров требуют определения и уточнения системы обучения кадров, соответствует насущным потребностям. Товарищи! консультация с широким активом в значительной степени обуславливает создание форм развития.</p>
                </li>
            </ul>
        </div>
        <form class="settings form main__block hide" action="#" method="POST">
            <input class="input" type="text" name="name" placeholder="имя">
            <input class="input" type="text" name="surname" placeholder="фамилия">
            <input class="input" type="password" name="password" placeholder="пароль">
            <input class="input" type="password" name="repeat_password" placeholder="повторите пароль">
            <button class="button button_purple form__button">Сохранить</button>
        </form>
    </main>
    <script>
        function change(block) {
            $('.main__block').addClass('hide');
            $(block).removeClass('hide');
        }
        $('.nav__item').click(function() {
            $('.nav__item').removeClass('active');
            $(this).addClass('active');
            if ($(this).text() == 'Подписки') {
                change('.subscriptions')
            }
            else if ($(this).text() == 'Посты') {
                change('.posts')
            }
            else if ($(this).text() == 'Настройки') {
                change('.settings')
            }
        })
    </script>
    <script src="js/functions.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>