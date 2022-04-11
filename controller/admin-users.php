<?php
include ('../../database/database.php');

$login = '';
$email = '';
$errMsg = '';
$selectAll = selectAll('users');

//test($selectAll);
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo 'POST';
}else{
    echo 'GET';
}

if (isset ($_POST['users_create'])) {
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $firstPass = trim($_POST['pass-first']);
    $secondPass = trim($_POST['pass-second']);
    (empty($_POST['select']))?$admin = 0 : $admin = 1;
    //test($admin);
    if ($login === '' || $email === '' || $firstPass === '') {
        $errMsg = 'Вы пропустили поле';
    } elseif (mb_strlen($login, 'UTF-8') <= 2 ){
        $errMsg = 'Имя не может состоять из 2-х букв !';
    }elseif ($firstPass !== $secondPass) {
        $errMsg = 'Пароли не совпали введите заново';
    }
    elseif ( selectOne ( 'users',['email' => $email]) != 0){
        $errMsg = 'Такой email уже существует !';
    }
    else {
        $pass = password_hash($firstPass, PASSWORD_DEFAULT);
        $arrForm = [
            'username' => $login,
            'email' => $email,
            'password' => $pass,
            'admin' => $admin
        ];
        //printer($arrForm);
        //exit();
        insert ('users', $arrForm);
        header('location: ' .BASE_URL .'admin/users/index.php');
        //printer($arrForm);
        //$checkArr = collOne('users', $arrForm);
        //printer($checkArr);
    }

}

//---------------      edit     ---------------------//
if(isset($_GET['edit_id_user'])){
    $id = $_GET['edit_id_user'];
    $oneUser = selectOne('users', ['id' => $id]);
    //test($oneUser);
    $admin = $oneUser['admin'];
    $username = $oneUser['username'];
    $email = $oneUser['email'];
}



//-------------------ОБНОВИТЬ ЮЗЕРА--------------------------

if (isset ($_POST['users_edit'])) {
    //test($_POST);
    $upload_id = $_POST['upload_id'];
    $username = trim($_POST['login']);
    $email = trim($_POST['email']);
    $firstPass = trim($_POST['pass-first']);
    $secondPass = trim($_POST['pass-second']);
    (empty($_POST['select']))?$admin = 0 : $admin = 1;
    //test($admin);
    if ($username === '' || $email === '' || $firstPass === '') {
        $errMsg = 'Вы пропустили поле';
    } elseif (mb_strlen($username, 'UTF-8') <= 2 ){
        $errMsg = 'Имя не может состоять из 2-х букв !';
    }elseif ($firstPass !== $secondPass) {
        $errMsg = 'Пароли не совпали введите заново';
    }
    else {


        $pass = password_hash($firstPass, PASSWORD_DEFAULT);
        $arrForm = [
            'username' => $username,
           // 'email' => $email,
            'password' => $pass,
            'admin' => $admin
        ];
        //test($arrForm);
        //printer($arrForm);
        //exit();
        update('users',$upload_id, $arrForm);
        header('location: ' .BASE_URL .'admin/users/index.php');
        //printer($arrForm);
        //$checkArr = collOne('users', $arrForm);
        //printer($checkArr);
    }

}






//-----------------------------------DELETE---------------
if(isset($_GET['delete_user_id'])){
    $id =  $_GET['delete_user_id'];
    delete('users', $id);
    header('location: ' .BASE_URL .'admin/users/index.php');
}








