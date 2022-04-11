<?php  session_start() ?>
<?php include("../../path.php") ?>
<?php include ("../../controller/admin-users.php")?>
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
    <title>users/index</title>
</head>

<body>
<div class="wr">

    <?php include ("../../include/header-admin.php" ); ?>
    <div class="container">

            <?php include "../../include/sidebar-admin.php" ?>

            <div class="posts col-9">
                <div class="button row">
                    <a href="create.php" class="col-2 btn btn-success">Создать</a>
                    <a href="index.php" class="col-2 btn btn-warning">Управление</a>
                </div>
                <div class="row title-table">
                    <h2>Управление пользователями</h2>
                    <div class="col-1">ID</div>
                    <div class="col-3">Логин</div>
                    <div class="col-3">Email</div>
                    <div class="col-1">Роль</div>
                    <div class="col-2">Управление</div>

                </div>
                <?php foreach ($selectAll as $key => $value): ?>
                <div class="row post">
                    <div class="id col-1"><?= $key + 1?></div>
                    <div class="title col-3" style="overflow: hidden"><?= $value['username']?></div>
                    <div class="title col-3" style="overflow: hidden"><?= $value['email']?></div>
                    <div class="title col-1"><?php if ($value['admin']): echo 'Admin'; else: echo 'User'; endif?></div>
                    <div class="autor col-2"><a href="edit.php?edit_id_user=<?= $value['id']?>">edit</a></div>
                    <div class="del col-2"><a href="?delete_user_id=<?= $value['id']?>">Delete</a></div>
                </div>
                <?php endforeach?>
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
</body>

</html>
