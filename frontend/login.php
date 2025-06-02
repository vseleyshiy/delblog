<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Login | DelBlog</title>
	<?php require_once 'components/header_scripts.php' ?>
	<link rel="stylesheet" href="css/index.css" />
	<link rel="stylesheet" href="css/form.css" />
</head>

<body>
	<div class="wrapper">
		<div class="content">
			<?php require_once './components/header.php' ?>
			<div class="container">
				<div class="form__wrap">
					<div class="form">
						<div class="form__title">Войдите в аккаунт</div>
						<label class="form__row">
							Email:
							<input type="email" placeholder="Введите email..." />
						</label>
						<label class="form__row">
							Password:
							<input type="password" placeholder="Введите пароль..." />
						</label>
						<button id="submit" class="submit">Войти</button>
						<span class="else">
							Ещё не зарегестрированы?
							<a href="reg.php" class="link"> Регистрация </a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'components/footer.php' ?>
	</div>
	<?php require_once 'components/scripts.php' ?>
	<script src="js/services/auth.service.js" type="module"></script>
	<script src="js/login.js" type="module"></script>
</body>

</html>