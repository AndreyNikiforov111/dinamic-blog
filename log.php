<?php
 include"path.php";
 include "controller/users.php";


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
	<title>Log</title>
</head>

<body>
	<div class="wr">
		<div class="stic-foot reg_log">
			<div class="cont">
                <?php include ("include/header.php"); ?>

				<!-- END HEADER -->

				<!-- FORM -->

				<div class="container reg_form">

					<form action="log.php" method="post" class="row justify-content-md-center">
						<h3>Форма регистрации</h3>
                        <div class="mb-3 col-12 col-md-4 err">
                            <p><?=$errMsg?></p>
                        </div>
                        <div class="w-100"></div>
						<div class="mb-3 col-12 col-md-4">
							<label for="formGroupExampleInput" class="form-label">Ваш email</label>
                            <input type="email" class="form-control" value="<?=$email?>" placeholder="Введите email" id="exampleInputEmail1" name="email">

                        </div>
						<div class="w-100"></div>

						<div class="mb-3 col-12 col-md-4">
							<label for="exampleInputPassword1" class="form-label">Пароль</label>
							<input type="password" class="form-control" placeholder="Введите пароль"
								id="exampleInputPassword1"   name="password">
						</div>

						<div class="w-100"></div>
						<div class="mb-3 col-12 col-md-4 sub" id="sub">
							<button type="submit" class="btn btn-primary btn-secondary" name="button-log">Войти</button>
							<a href="reg.php">Зарегистрироваться</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- END FORM -->



		<!-- FOOTER -->

        <?php include ('include/footer.php')?>
	</div>
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