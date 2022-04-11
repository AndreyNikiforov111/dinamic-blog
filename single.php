<?php
include"path.php";
include "database/database.php";
//$onePost = selectOne('posts', ['id' => $_GET['id_post']]);
// test($onePost);
//$topTopics =selectTopTopicsFromPostAndIndex('posts');
//test($topTopics);
//test($_GET['id_post']);
$single = userAndPostSingle('posts', 'users', $_GET['id_post']);
//test($single);
$top = selectAll('topics');

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



	<link rel="stylesheet" href="css/style.css">
	<title>Single</title>
</head>

<body>
<div class="wr">
    <?php include ("include/header.php" ); ?>

	<!--   блок main   -->

	<div class="container">
		<div class="sinle_post row">
			<div class="main-content col-md-9 col-12">
				<span>
					<h2><?= $single['title'];?></h2>
				</span>
				<div class="post row">
					<div class="img col-12 col-md-4">
						<img src="<?= BASE_URL .'/img/posts/'. $single['img'];?>" alt="<?= $single['title'];?>" class="img-thumbnail">
						<div class="avtor">
							<i class="far fa-user"><span><?= $single['username'];?></span></i>
							<i class="fa-solid fa-calendar"><span style="font-weight: normal"><?= mb_substr($single['created_date'], 0, 10, 'UTF-8');?></span></i>
						</div>
					</div>
					<div class="single_post_text col-12 col-md-8">
                        <?= $single['content'];?>
					</div>
				</div>
                <!--   КОММЕНТАРИИ   -->
                <?php include ("include/comment.php" ); ?>
			</div>


            <!--       SIDEBAR         -->
			<div class=" sidebar col-md-3 col-12">
				<div class="section search">
					<h3>Поиск</h3>
					<form action="search.php" method="post">
						<input type="text" name="search-term" class="text-input" placeholder="Search...">
                    </form>
				</div>
				<div class="section topics">
                    <h3>Каегории</h3>
                    <?php foreach ($top as $key => $value):?>
                        <ul>
                            <li><a href="<?=BASE_URL.'category.php?id_category='.$value['id']?>"><?=$value['name']?></a></li>
                        </ul>
                    <?php endforeach;?>
				</div>
			</div>


		</div>
	</div>

	<!--    конец блока main -->

    <?php include ('include/footer.php')?>
</div>



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