<?php
session_start();

include "path.php";

unset($_SESSION['id']);    //функция удаление чего либо
unset($_SESSION['login']);// например сессии
unset($_SESSION['email']);
unset($_SESSION['admin']);




header('location: ' . BASE_URL);






