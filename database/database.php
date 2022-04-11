<?php
session_start();
require ('connect.php');

function test ($value){
    echo '<pre>';
    print_r($value);                    // здесь распечатали этот массив
    echo  '<pre>';
    exit();
}

function testE ($value){
    echo '<pre>';
    print_r($value);                    // здесь распечатали этот массив
    echo  '<pre>';
}
//проверка на ошибку
function checkError($query) {
    $errInfo = $query->errorInfo();
    if($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}
$params = [
    'admin' => 1,
    'username' => 'some'
];


//Запрос на получение данных от одной таблицы
function selectAll($table, $params = []){
    global $pdo;                      // обращаемся к глобальной переменной
    $sql = "SELECT * FROM $table";    // подготавливаем запрос
    // ставим имя таблицы

    if (!empty($params)){               // здесь формируем запрос из массива с пораметрами
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";   // проходимся по массиву, если пораметр в таблице не числовой
                                           // ставим к нему ковычки
            }
            if($i === 0){
                $sql = $sql ." WHERE $key = $value";       // добавляем к sql запрсу пораметры из таблицы
            }else{
             $sql = $sql ." AND $key = $value";
            }
        $i++;
        }

    }
    //test($sql);
    $query = $pdo -> prepare($sql);
  //  checkError($query);     // проверяем на ошибки
    $query-> execute();

  //
  // exit();


    return $query->fetchAll();          // здесь получили массив всей базы
}
//test(selectAll('users', $params));


//  Можно сделать чтобы обновлялись только после пост запросов
//  а после гет не обновлялись

//перебор массива забирает ЦПУ

// хождение в базу забирает оперативную память
$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');
//test($postsAdm);





//Запрос на получение одной строки от одной таблицы
function selectOne($table, $params = []){
    global $pdo;                      // обращаемся к глобальной переменной
    $sql = "SELECT * FROM $table";    // подготавливаем запрос
    // ставим имя таблицы


    if (!empty($params)){               // здесь формируем запрос из массива с пораметрами
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";   // проходимся по массиву, если пораметр в таблице не числовой
                // ставим к нему ковычки
            }
            if($i === 0){
                $sql = $sql ." WHERE $key = $value";       // добавляем к sql запрсу пораметры из таблицы
            }else{
                $sql = $sql ." AND $key = $value";
            }
            $i++;
        }

    }
    $sql = $sql." LIMIT 1";
//test($sql);

    $query = $pdo ->prepare($sql);
    $query-> execute();

    checkError($query);     // проверяем на ошибки



    return $query->fetch();          // здесь получили массив всей базы
}
/*
 * $topic = [
    'name'        => 'hi hitlet',
    'description' => 'helloadaddada
aaaaaaaaa'
];
*/

//test(selectOne('topics', $topic));      // Выводит первого пользователя


/*$sql = "SELECT * FROM users";
$query = $pdo ->prepare($sql);
$query-> execute();
$errInfo = $query->errorInfo();
$date = $query-> fetch();
*/


//    Записи в таблицу may-dinamic

function insert($table, $arrData){
  //  "INSERT INTO $table ( admin, username, email, password) VALUES ( :admin , :user, :mail, :pass)";
    global $pdo;
    $i=0;
    $coll = '';
    $mask = '';
    foreach ($arrData as $key => $value){
if($i===0) {
    $coll = $coll.$key;
    $mask = $mask."'" .$value."'" ;
}else{
    $coll = $coll . ", $key";
    $mask = $mask .", '"."$value"."'";
}
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    //test($sql);
    // exit();

    $query = $pdo ->prepare($sql);
    $query-> execute();
    checkError($query);     // проверяем на ошибки
    return $pdo->lastInsertId();        // получаем последний id зарегестрированный в базе данных
   // return $query->fetch();          // здесь получили массив всей базы
}
$arrData = [
    'status' => 0,
    'email' => 'andrey.nikiforov.116@gmail.com',
    'comment' => 'отзыв лол',
    'page' => 28
];

//test(insert('comments', $arrData));

//    Обновление строки в таблице

function update($table,$id, $up){
    //  "INSERT INTO $table ( admin, username, email, password) VALUES ( :admin , :user, :mail, :pass)";
    global $pdo;
    $i=0;
    $coll = '';
    $mask = '';
    foreach ($up as $key => $value){
        if ($i === 0){
            $coll = $coll." `".$key."` = '".$value."'";
        }
        else {
            $coll = $coll . ", `" . $key . "` = '" . $value . "'";
        }
        $i++;
    }
   // UPDATE `users` SET `username`= 'test', `password` = '55555'  WHERE `id` = 6;
    $sql = "UPDATE $table SET $coll WHERE `id` =  $id";

   // test($sql);
    //exit();

    $query = $pdo ->prepare($sql);
    $query-> execute();
    checkError($query);     // проверяем на ошибки

    return $query->fetch();          // здесь получили массив всей базы
}
$up = [

    'admin'=> '0'
];

//test(update('users', 6, $up));


function delete($table,$id){
    //  "INSERT INTO $table ( admin, username, email, password) VALUES ( :admin , :user, :mail, :pass)";
    global $pdo;

    // UPDATE `users` SET `username`= 'test', `password` = '55555'  WHERE `id` = 6;
    $sql = "DELETE FROM $table WHERE `id` =  $id";

   // test($sql);


    $query = $pdo -> prepare($sql);
    $query-> execute();
    checkError($query);     // проверяем на ошибки

    return $query->fetch();          // здесь получили массив всей базы
}


//test(delete('users', 4));

function oldEmail($ownE) {

    $sqlE = "SELECT  `email` FROM `users`";
    global $pdo;
    $query = $pdo->prepare($sqlE);
    $query->execute();
    checkError($query);     // проверяем на ошибки

    $arr = $query->fetchAll();
//print_r($arr);
    $count = $query->rowCount();
    $errOr = '';

    for ($i = 0; $i < $count; $i++) {
        $arr[$i];

        foreach ($arr[$i] as $key => $value) {
            if ($value === $ownE) {
                /*$errMsg = 'Такой пользователь уже существует';*/
                return true;
            }
        }
    }
}
$ownE= 'forov.116@gmail';
//oldEmail($ownE);


//Выборка записей (posts) с автором в админку
function selectAllFromPostsWithUsers($table1, $table2){
    global $pdo;
    $sql = "SELECT
               t1.id,
               t1.title,
               t1.img,
               t1.content,
               t1.status,
               t1.id_topic,
               t1.created_date,
               t2.username
     FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";

    $query = $pdo -> prepare($sql);
    //  checkError($query);     // проверяем на ошибки
    $query-> execute();

    //
    // exit();
    return $query->fetchAll();
}

// просто соединил три таблицы и вывел в одну основные пораметры
function ass($table1, $table2, $table3){
    global $pdo;
    $sql = "SELECT
        /*Перечисляем пораметры которые надо вывести в том порядке какие хотим вывести*/
    t3.id,
    t1.username,
    t1.email,
    t2.name,   
    t3.title,
    t3.img,
    t3.content       
    FROM $table1 AS t1 JOIN $table2 AS t2 LEFT JOIN $table3 AS t3 ON t1.id = t3.id_user AND t3.id_topic = t2.id";
    // сращиваем в одной основной таблице POSTS     id_users(posts) = id(user)  id_topics(posts) = id(topics)
//test($sql);

    $query = $pdo -> prepare($sql);
    $query-> execute();
    return $query->fetchAll();
}


//test(ass('users', 'topics', 'posts'));

function picture ($imgArr, $rootPath, $errMsg){
    if (!empty($imgArr['name'])){
        // чтобы небыло одних и тех же картинок меняем им имя
        $imgName =  time().'_'.$imgArr['name'];
        $fileTmpName = $imgArr['tmp_name'];
        $fileType = $imgArr['type'];// Проверка типа принятого файла на картинку
        $destination = $rootPath ."\img\posts\\".$imgName;
        //путь куда мы грузим

        // В переменной должно находиться 'image'
        if (!str_contains($fileType, 'image')){

            array_push($errMsg, 'Можно загружать только изображения');
            return $errMsg;
        } else {
            //test($destination);
            //Функция отправки картинки
            // перенаправляет загруженный файл       отсюда          сюда
            $result = move_uploaded_file($fileTmpName, $destination);
            //test($destination);
            //  мы отправляем его картинку на сервер тоесть на наш компьютер в папку img posts
            //test ($result);
            if ($result) {
               // test($imgName);
                return $imgName;
            } else {
                array_push($errMsg, 'Ошибка отрпавки изображения на сервер');
                return  $errMsg;
            }

            // СЮДА

        }
    }else{
       array_push($errMsg, 'Изображение не получено');
       return $errMsg;
    }
}

//Вывод записи с автором на главную
function userAndPost($table1, $table2, $limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1 LIMIT $limit OFFSET $offset";

    $query = $pdo -> prepare($sql);
    //  checkError($query);     // проверяем на ошибки
    $query-> execute();

    //
    // exit();
    return $query->fetchAll();
}
//test(userAndPost( 'posts', 'users'));

//Вывод записи с автором на главную
function selectTopTopicsFromPostAndIndex($table){
    global $pdo;
    $sql = "SELECT * FROM $table WHERE `id_topic` = 37";

    $query = $pdo -> prepare($sql);
    //  checkError($query);     // проверяем на ошибки
    $query-> execute();
    // exit();
    return $query->fetchAll();
}




function searchTitleAndContent($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT 
       p.*, u.username 
       FROM $table1 AS p 
       JOIN $table2 AS u 
       ON p.id_user = u.id 
       WHERE p.status=1
       AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";

        //test($sql);
    $query = $pdo -> prepare($sql);
    //checkError($query);     // проверяем на ошибки
    $query-> execute();

    // exit();
    return $query->fetchAll();
}
//$userAnsPost = searchTitleAndContent('test', 'posts', 'users');
//test($userAnsPost);


//выборка поста и автора вывод в single
function userAndPostSingle($table1, $table2, $id){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";

    $query = $pdo -> prepare($sql);
    //  checkError($query);     // проверяем на ошибки
    $query-> execute();

    //
    // exit();
    return $query->fetch();
}



// CATEGORY
function selectAllandUser($table1, $table2, $id_topic, $limit, $offset){
    global $pdo;
    $sql = "SELECT
        /*Перечисляем пораметры которые надо вывести в том порядке какие хотим вывести*/
    t2.id,
    t2.username,
    t1.*   
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id WHERE t1.id_topic = $id_topic  LIMIT $limit OFFSET $offset";
    // сращиваем в одной основной таблице POSTS     id_users(posts) = id(user)  id_topics(posts) = id(topics)
    //test($sql);

    $query = $pdo -> prepare($sql);
    $query-> execute();
    return $query->fetchAll();
}
//test(selectAllandUser('posts', 'users',  30 , 2, 0));
//test(selectAllandUser('posts', 'users',  30));

function countRow($table1, $id_topic = false){
    global $pdo;
    if ($id_topic === false)
        $sql = "SELECT COUNT(*) FROM $table1 WHERE status = 1 ";
    else
        $sql = "SELECT COUNT(*) FROM $table1 WHERE status = 1 AND id_topic = $id_topic";
    $query = $pdo -> prepare($sql);
    //checkError($query);     // проверяем на ошибки
    $query-> execute();
    // exit();
    return $query->fetchColumn();
}
//test(countRow('posts'));







