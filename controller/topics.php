<?php

//  ЧТОБЫ К ОДНОМУ ФАЙЛУ / КОНТРОЛЛЕРУ / МОЖНО БЫЛО ПОДКЛЮЧИТЬ НЕСКОЛЬКО ФАЙЛОВ
// МЫ ИСП АБСОЛЮТНЫЙ ПУТЬ __DIR__ .  и про / не надо забывать
// иначе жопа

include SITE_ROOT."/database/database.php";


/* Подключаемый файл видет путь из того места где находится его родительский файл подключающего обьекта */


//echo BASE_URL;
$errMsg ='';



if(isset($_POST['topic-create'])){

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if ($name === '' || $description === ''){
        $errMsg = 'Не все поля заполненны !';
    }elseif (mb_strlen($name, 'UTF-8') < 2){                // число элементов в строке
        $errMsg = 'Категория должена быть более 2-х символов';
    }

    else {
        $existence = selectOne('topics', ['name' => $name]);



        if(!empty($existence['name'])) {
            $errMsg = 'Такая категоря уже есть в базе';

        }
        else{

            $topic = [
                'name' => $name,
                'description' => $description
            ];
            //test($topic);       // здесь мы получаем массив со всеми данными
           $id = insert('topics', $topic);
           $topic = selectOne('topics', ['id' => $id]);   // а здесь массив с данными  и с id нашего пользователя
            header('location: '. BASE_URL . 'admin/topics/index.php');

        }






    }

}else{
    $name = '';
    $errMsg ='';
    $description='';
}


//Редактировать категорию                   edit
if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['id'])){
    $id = $_GET['id'];
    $topic = selectOne('topics', ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];

    $idOld = $_GET['id'];

    $_SESSION['idOld'] = $idOld;
}




// с кнопки заходт
if(isset($_POST['topic-edit'])){

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if ($name === '' || $description === ''){
        $errMsg = 'Не все поля заполненны !';
    }elseif (mb_strlen($name, 'UTF-8') < 2){                // число элементов в строке
        $errMsg = 'Категория должена быть более 2-х символов';
    }

    else {
        $existence = selectOne('topics', ['name' => $name]);
        //test( $existence);

        if(!empty($existence['name'])) {

            $errMsg = 'Такая категоря уже есть в базе';
            $topic = [
              'name' => $name,
              'description' => $description
            ];

            $up = update('topics',  $existence['id'], $topic);

            header('location: '. BASE_URL . 'admin/topics/index.php');


        }
        else{


            $delete = delete('topics', $_SESSION['idOld']);

            $topic = [
                'name' => $name,
                'description' => $description
            ];

            //test($topic);       // здесь мы получаем массив со всеми данными
            $id = insert('topics', $topic);

            header('location: '. BASE_URL . 'admin/topics/index.php');

        }
    }
}

//Редактировать категорию                   delete
if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('topics', $id);
    header('location: ' .BASE_URL . 'admin/topics/index.php');
   // header("Refresh: 1");
}









































