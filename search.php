<?php
include("path.php");
//  ЧТОБЫ К ОДНОМУ ФАЙЛУ / КОНТРОЛЛЕРУ / МОЖНО БЫЛО ПОДКЛЮЧИТЬ НЕСКОЛЬКО ФАЙЛОВ
// МЫ ИСП АБСОЛЮТНЫЙ ПУТЬ __DIR__ .  и про / не надо забывать
include SITE_ROOT . "/database/database.php";
if ($_SERVER['REQUEST_METHOD'] ===  'POST' && isset($_POST['search-term'])) {
	$userAnsPost = searchTitleAndContent($_POST['search-term'], 'posts', 'users');
	//test($userAnsPost);
}

?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/adcf64d6a8.js" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">



	<link rel="stylesheet" href="css/style.css">
	<title>index</title>
</head>

<body>
	<div class="wr">

		<?php include("include/header.php"); ?>

		<div class="container reg_form">

			<!--   блок main  ----------------------------------------------------------------------- -->

			<div class="container">
				<div class="content row">
					<div class="main-content  col-12">
						<span>
							<h2>Результаты поиска</h2>
                            <?php if (count($userAnsPost) == 0): ?><p>По вашему запросу ничего не найдено ( </p> <?php endif;?>
						</span>
                        <?php if (count($userAnsPost) == 0): ?>
                        <div class=" sidebar col-12">
                            <div class="section search">
                                <h3>Поиск</h3>

                                <form action="search.php" method="post">
                                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                                    <div class="mb-3 col-12 col-md-4 sub" id="sub">
                                        <button type="submit" class="arr" style="margin-top:1em" name="search-term">Поиск</button>
                                       <!-- <a href="search.php">Авторизоваться</a>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php else:?>
						<?php foreach ($userAnsPost as $post) : ?>
							<div class="post row" style="display: flex; padding: 7.5px; align-items: center">
								<div class="img col-12 col-md-4">
									<img src="<?= BASE_URL . 'img/posts/' . $post['img'] ?>" alt="<?= mb_substr($post['title'], 0, 50, 'UTF-8');
																												if (strlen($post['title']) > 50) echo '...'; ?>" class="img-thumbnail">
								</div>
								<div class="post_text col-12 col-md-8">
									<h4>
										<a href="<?= BASE_URL . 'single.php?id_post=' . $post['id'] ?>"><?= mb_substr($post['title'], 0, 50, 'UTF-8');
																														if (strlen($post['title']) > 50) echo '...' ?></a>
									</h4>
									<p class="preview-text">
										<?= mb_substr($post['content'], 0, 150, 'UTF-8');
										if (strlen($post['content']) > 150) echo '...' ?>
									</p>
									<div class="avtor">
										<i class="far fa-user"><span><?= $post['username'] ?></span></i>
										<i class="fa-solid fa-calendar"><span>Mar 11, 2019</span></i>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
                        <?php endif ?>
						<!--<div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="img/3.jfif" alt="" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                            <h4>
                                <a href="single.php">Прикольная статья на тему динамического сайта...</a>
                            </h4>
                            <p class="preview-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium deleniti veritatis
                                necessitatibus, officia sed doloribus distinctio alias mollitia, modi aspernatur ipsam fuga
                                voluptate
                                labore ab in quo. A, tenetur quaerat.
                            </p>
                            <div class="avtor">
                                <i class="far fa-user"><span>Имя автора</span></i>
                                <i class="fa-solid fa-calendar"><span>Mar 11, 2019</span></i>
                            </div>
                        </div>
                    </div>

                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="img/5.jfif" alt="" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                            <h4>
                                <a href="single.php">Прикольная статья на тему динамического сайта...</a>
                            </h4>
                            <p class="preview-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium deleniti veritatis
                                necessitatibus, officia sed doloribus distinctio alias mollitia, modi aspernatur ipsam fuga
                                voluptate
                                labore ab in quo. A, tenetur quaerat.
                            </p>
                            <div class="avtor">
                                <i class="far fa-user"><span>Имя автора</span></i>
                                <i class="fa-solid fa-calendar"><span>Mar 11, 2019</span></i>
                            </div>
                        </div>
                    </div>

                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="img/3.jfif" alt="" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                            <h4>
                                <a href="single.php">Прикольная статья на тему динамического сайта...</a>
                            </h4>
                            <p class="preview-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium deleniti veritatis
                                necessitatibus, officia sed doloribus distinctio alias mollitia, modi aspernatur ipsam fuga
                                voluptate
                                labore ab in quo. A, tenetur quaerat.
                            </p>
                            <div class="avtor">
                                <i class="far fa-user"><span>Имя автора</span></i>
                                <i class="fa-solid fa-calendar"><span>Mar 11, 2019</span></i>
                            </div>
                        </div>
                    </div>-->
					</div>


				</div>
			</div>
		</div>

		<!--    конец блока main -->

		<?php include('include/footer.php') ?>
    </div>

	<!-- Optional JavaScript; choose one of the two! -->
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>