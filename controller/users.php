<?php
include("database/database.php");
/* Подключаемый файл видет путь от места положения полключающего обьекта */
$isSubmit = false;          // состояние отправления в базу данных
$errMsg = '';

                                            // Код с формы регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){

    echo 'POST';
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passFirst = $_POST['pass-first'];
    $passSecond = trim( $_POST['pass-second']);
    $admin = 0;
    $checkEmail = oldEmail($email);


    if ($login === '' || $email === '' || $passSecond === ''){
        $errMsg = 'Не все поля заполненны !';
    }elseif (mb_strlen($login, 'UTF-8') < 2){                // число элементов в строке
        $errMsg = 'Логин должен быть более 2-х символов';
    }elseif ($passSecond !== $passFirst){
        $errMsg = 'Пароли не совпадают !';
    }
    elseif ($checkEmail === true) $errMsg = 'Такой пользователь уже существует';



    else {

            $pass = password_hash($passSecond, PASSWORD_DEFAULT);   //кодируем наш пароль
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $isSubmit = true;                     // если записалась форма то состояние изменилось
            $id =  insert('users', $post);          // находим id регоного пользователя

            $user = selectOne('users', ['id' => $id]);      // получаем весь массив с данными регоного пользователя
           // test($user);
      // Записываем в сессию нового пользователя
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            if ($_SESSION['admin']){
                header('location: ' .BASE_URL. 'admin/posts/index.php');
            }else {
                header('location: ' . BASE_URL);         // отправляем реганого пользователя на главную страницу
            }



            //test($_SESSION);




    }

}else{
    echo 'GET';
    $login = '';
    $email = '';
}

                                                // Код формы логирования
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){

    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if ($email === '' || $pass === ''){
        $errMsg = 'Не все поля заполненны !';
    }else {
        $existeone = selectOne('users', ['email' => $email]);
//test($existeone);
//проверяем нашелся ли пользователь под емейлом  // проверяем совпадение хешированного пароля из бд
        if($existeone && password_verify($pass, $existeone['password'])){
            echo 'Авторизовать';

            $_SESSION['id'] = $existeone['id'];
            $_SESSION['login'] = $existeone['username'];
            $_SESSION['email'] = $existeone['email'];
            $_SESSION['admin'] = $existeone['admin'];
            if ($_SESSION['admin']){
                header('location: ' .BASE_URL. 'admin/posts/index.php');
            }else {
                header('location: ' . BASE_URL);         // отправляем этого пользователя на главную страницу
            }

        }else{
            $errMsg = 'Ошибка авторизации';
        }
    }
}else{
    $email = '';
}
/*$email= '9@gm1www1ail.com';
$existeone = selectOne('users', ['email' => $email]);
test($existeone);*/








