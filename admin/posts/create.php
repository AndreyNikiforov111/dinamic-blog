<?php
include("../../path.php") ;
include ("../../controller/posts.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/adcf64d6a8.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">



    <link rel="stylesheet" href="../../css/admin.css">
    <title>posts/create</title>
</head>

<body>
<div class="wr">

    <?php include ("../../include/header-admin.php" ); ?>
    <div class="container">

            <?php include "../../include/sidebar-admin.php" ?>

            <div class="posts col-9">
                <div class="button row">
                    <a href="<?php echo BASE_URL ."admin/posts/create.php" ?>" class="col-2 btn btn-success">Создать</a>
                    <a href="<?php echo BASE_URL ."admin/posts/index.php" ?>" class="col-2 btn btn-warning">Редактировать</a>
                </div>
                <div class="row title-table">
                    <h2>Добавление записи</h2>
                    <!--     массив с ошибками   -->
                    <?php include SITE_ROOT."/helps/errorinfo.php" ?>

                </div>
                <div class="row add-post"><!--подгужаем файлы во временную память нашего сервера-->
                                          <!--  По сути создаем массив с картинкой $_FILE   -->
                    <form action="create.php" enctype="multipart/form-data" method="post">
                        <div class="col mb-2" id="marg">
                                <input type="text" name="title" value="<?=$title?>" class="form-control" placeholder="Title" aria-label="Название статьи">
                        </div>

                        <div class="col">
                            <label for="content" class="form-label">Содержимое записи</label>
                            <textarea class="form-control" name="content" id="editor" rows="3"><?=$content?></textarea>
                        </div>

                        <div class="input-group col mb-4">
                            <!-- ключь к массиву $_FILE -->
                            <input name="img" type="file" class="form-control" id="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-secondary" type="button" id="file">Upload</button>
                        </div>

                        <select name="section" class="form-select mb-4" aria-label="Default select example">
                            <option selected="<?=$key+1?>">Категоря поста:</option>
                            <? foreach ($topics as $key => $value): ?>
                            <option value="<?= $value['id']?>"><?= $value['name']?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-check" style="margin: 20px 0">
                            <input class="form-check-input" type="checkbox" name="publish" id="publish">
                            <label class="form-check-label" for="publish" style="margin-left: 9px">
                                Опубликовать
                            </label>
                        </div>
                        <div class="col">
                            <button name="add_post" class="btn btn-primary mb-4" type="submit">Добавить запись</button>
                        </div>
                    </form>
                </div>
            </div>

    </div>


</div>
    <?php include ('../../include/footer.php')?>
































<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
<!-- Добавление визуального редактора к текстовому полю админки  -->
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script src="../../js/script.js"></script>
</body>

</html>