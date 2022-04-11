<?php
include_once SITE_ROOT.'/database/database.php';

$commentsForAdmin = selectAll('comments');

if (isset($_GET['id_post'])) {
    $page = $_GET['id_post'];
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}

//$id_post = $_POST;
//var_dump($id_post);
//test($_GET['id_post']);

$email = '';
$comment = '';
$errMsg = [];
$status = 1;
//testE($_POST);
/* Подключаемый файл видет путь из того места где находится его родительский файл подключающего обьекта */

//test ($errMsg)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo 'GET';
} else {
    echo 'POST';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {
    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);
    //echo 'hi'.'<br>';
    // test($_SESSION);
    //test($_POST);
    //test($publish);
    //exit();
    if ($email === '' || $comment === '' ) {
        //echo 'err';
        array_push($errMsg, 'Не все поля заполненны !');
    } elseif (mb_strlen($comment, 'UTF-8') < 3) {                // число элементов в строке
        //echo 'err';
        array_push($errMsg, 'Комментарий не может содержать меньше 3 символов');
    }
    else {
        $user = selectOne('users', ['email' => $email]);
        if (isset($user['email'])){
            $status = 1;
        }
        $comment = [
            'status' =>  $status,
            'email' =>   $email,
            'comment' => $comment,
            'page' =>    $page
        ];
        //  test($comment);       // здесь мы получаем массив со всеми данными
        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
        //array_splice($_POST, 0, count($_POST));

        //test($_POST);
        header('location: ' .BASE_URL . "single.php?id_post=$page");
        //header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}


//уд коммент
if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['delete_id_post'])){
    $id = $_GET['delete_id_post'];
    //test($id);
    delete('comments', $id);
    header('location: ' .BASE_URL . 'admin/comment/index.php');
    // header("Refresh: 1");
}


/*------------------------------------------------------*/
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    //test($_GET);
    $arr = $_GET['public'];
    update('comments', $id, ['status' => $arr]);
    header('location: ' . BASE_URL . 'admin/comment/index.php');
    // header("Refresh: 1");
}



//Редактировать пост                  edit
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = selectOne('comments', ['id' => $id]);

    // test($select);

    $email = $select['email'];
    $comment = $select['comment'];
    $status = $select['status']; //  1  (0)
    $page = $select['page'];
    $commentOne = selectOne('topics', ['id' => $id]);
    // ТОПИК НУЖЕН ДЛЯ ВЫВОДА ИМЕНИ ТЕМЫ НА СТРАНИЦУ (JS, PHP, HTML)
    //$username = $topic['username'];
    // print_r($topic) ;
    //echo $id;
    // test($topics);
    //test($postsAdm);

}


// ---------------------- РЕДАКТИРОВАТЬ ПОСТ ---------------
// с кнопки заходт
if (isset($_POST['edit_comment'])) {
    $id = $_POST['id'];
    $comment = trim($_POST['content']);
    $status  = isset($_POST['publish']) ? 1 : 0;
    //test($_POST);

    if ($comment === '' ) {
        array_push($errMsg, 'Не все поля заполненны !');
    } elseif (mb_strlen($comment, 'UTF-8') < 5) {                // число элементов в строке
        array_push($errMsg, 'Категория должена быть более 5-и символов');
    }
    else {
        $arr = [
            'id' => $id,
            'status' => $status,
            'comment' => $comment,
        ];
        //test($arr);
        update('comments', $id, $arr);
        header('location: ' . BASE_URL . 'admin/comment/index.php');
    }
}



// УДАЛИТЬ КОММЕНТ НА СТРАНИЦЕ СИНГЛ
if($_SERVER['REQUEST_METHOD'] === 'GET' &&  isset($_GET['delete_id_post'])){
    $id = $_GET['delete_id_post'];
    //test($id);
    delete('comments', $id);
    header('location: ' .BASE_URL . 'admin/comment/index.php');
    // header("Refresh: 1");
}






























































