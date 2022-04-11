<?php
/*
$driver = 'mysql';
$host = 'localhost';
$db_name= 'andrezxc';
$db_user = 'andrezxc_123';
$db_pass = 'AG7VuxU4ib4yzCX';
$charset = 'utf8mb4';
*/


$driver = 'mysql';
$host = 'localhost';
$db_name= 'dinamic-site';
$db_user = 'root';
$db_pass = '';
$charset = 'utf8mb4';


$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];   // убоали из массива дублирующие строчки с ключем цифрой

try{
    $pdo = new PDO(
        "$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options
    );
}catch (DPOExeption $i){
    die('Ошибка подключения к базе данных');
}



