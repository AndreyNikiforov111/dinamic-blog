<?php

//  ЧТОБЫ К ОДНОМУ ФАЙЛУ / КОНТРОЛЛЕРУ / МОЖНО БЫЛО ПОДКЛЮЧИТЬ НЕСКОЛЬКО ФАЙЛОВ
// МЫ ИСП АБСОЛЮТНЫЙ ПУТЬ __DIR__ .  и про / не надо забывать
// иначе жопа

include SITE_ROOT."/database/database.php";


/* Подключаемый файл видет путь из того места где находится его родительский файл подключающего обьекта */


//echo BASE_URL;
$errMsg =[];
$section = '';
$img = '';
$publish = 0;
$title =  '';
$content = '';
//test ($errMsg)

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo 'GET';
}else{
    echo 'POST';
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){
    $err = '';
    //test($_FILES); // Массив с картинкой
    $imgArr = $_FILES['img'];
    //test($_FILES);
    $imgAnswer = picture($imgArr, ROOT_PATH, $errMsg);
    if (!is_array($imgAnswer)){
        $img = $imgAnswer;
        // test($imgAnswer);
    }else{
        $img = '';
        for($i=0; $i<count($imgAnswer); $i++){
            array_push($errMsg, $imgAnswer[$i]);
        }
        for ($i=0; $i<count($errMsg); $i++){
            if($errMsg[$i] == 'Можно загружать только изображения'){
                $err = 1;
            }
        }
    }

    //Это гавно можно перенести
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $section = $_POST['section'];

      if(isset( $_POST['publish'])){
        $publish = 1;
    }
        // test($_SESSION);
        //test($_POST);
        //test($publish);
        //exit();

    if ($title === '' || $content === '' || $section === 'Категоря поста:'){
        array_push($errMsg, 'Не все поля заполненны !');
    }elseif (mb_strlen($title, 'UTF-8') < 5){                // число элементов в строке
        array_push($errMsg, 'Название статьи должена быть менее 5-и символов');
    }elseif ($err){
       $none = 0;
    }
    else{

            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $img,
                'status' => $publish,
                'id_topic' => $section
            ];
          //  test($post);       // здесь мы получаем массив со всеми данными
        $id = $_SESSION['id'];
        $post = insert('posts', $post);
        $post = selectOne('posts', ['id_user' => $id]);   // а здесь массив с данными  и с id нашего пользователя
        header('location: '. BASE_URL . 'admin/posts/index.php');
    }
}

$status = '';

/*------------------------------------------------------*/

//Редактировать пост                  edit
if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['id'])){
    $id =  $_GET['id'];
    $select = selectOne('posts', ['id' => $id]);

   // test($select);
    $title = $select['title'];
    $topicId = $select['id_topic'];
    $status = $select['status']; //  1  (0)
    $content = $select['content'];
    $topic = selectOne('topics', ['id' => $topicId]);
    // ТОПИК НУЖЕН ДЛЯ ВЫВОДА ИМЕНИ ТЕМЫ НА СТРАНИЦУ (JS, PHP, HTML)
    //$username = $topic['username'];
    // print_r($topic) ;
    //echo $id;
    // test($topics);
    //test($postsAdm);

}



// ---------------------- РЕДАКТИРОВАТЬ ПОСТ ---------------
// с кнопки заходт
if(isset($_POST['edit_post'])){
    $id = $_POST['id'];
    $id_user = $_SESSION['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $id_topic = $_POST['section'];

    if (empty($_POST['publish'])){
        $status = 0;
    }else{
        $status =  1;
    }
    //test($_POST);

    $imgArr = $_FILES['img'];
    $imgAnswer = picture($imgArr, ROOT_PATH, $errMsg);
    if (!is_array($imgAnswer)){
        $img = $imgAnswer;
        // test($imgAnswer);
    }else{
        $img = '';
        for($i=0; $i<count($imgAnswer); $i++){
            array_push($errMsg, $imgAnswer[$i]);

        }for ($i=0; $i<count($errMsg); $i++){
            if($errMsg[$i] == 'Можно загружать только изображения'){
                $err = 1;
            }
        }

    }

    if ($title === '' || $content === ''){
        array_push($errMsg,'Не все поля заполненны !');
    }elseif (mb_strlen($title, 'UTF-8') < 5){                // число элементов в строке
        array_push($errMsg,'Категория должена быть более 5-и символов');
    }elseif ($err){
        $none = 0;
    }else {
        $arr = [
            'id' => $id,
            'id_user' => $id_user,
            'title' => $title,
            'img' => $img,
            'content' => $content,
            'status' => $status,
            'id_topic' => $id_topic
        ];
        //test($arr);
        update('posts', $id, $arr);
        header('location: ' .BASE_URL . 'admin/posts/index.php');
    }
}


if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    //test($id);
    $arr = $_GET['public'];
    update('posts', $id, ['status' => $arr]);
    header('location: ' .BASE_URL . 'admin/posts/index.php');
    // header("Refresh: 1");
}





//  Удалить ПОСТ                 delete
if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['delete_id_post'])){
    $id = $_GET['delete_id_post'];
    //test($id);
    delete('posts', $id);
    header('location: ' .BASE_URL . 'admin/posts/index.php');
    // header("Refresh: 1");
}












































