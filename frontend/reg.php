<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Registration | DelBlog</title>
	<?php require_once 'components/header_scripts.php' ?>
	<link rel="stylesheet" href="css/index.css" />
	<link rel="stylesheet" href="css/form.css" />
</head>

<body>
	<div class="wrapper">
		<div class="content">
			<?php require_once './components/header.php' ?>
			<div class="container">
				<span class="form__wrap">
					<div class="form">
						<div class="form__title">Создайте аккаунт</div>
						<label class="form__row">
							Name:
							<input type="text" placeholder="Введите имя..." />
						</label>
						<label class="form__row">
							Email:
							<input type="email" placeholder="Введите email..." />
						</label>
						<label class="form__row">
							Password:
							<input type="password" placeholder="Введите пароль..." />
						</label>
						<button class="submit" id="submit">Зарегистрироваться</button>
						<span class="else">
							Уже зарегестрированы?
							<a href="login.php" class="link">
								Логин
							</a>
						</span>
					</div>
			</div>
		</div>
		<?php require_once 'components/footer.php' ?>
	</div>
	<?php require_once 'components/scripts.php' ?>
	<script src="js/services/auth.service.js" type="module"></script>
	<script src="js/reg.js" type="module"></script>
</body>

</html>