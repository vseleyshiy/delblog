<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Admin Panel | DelBlog</title>
	<?php require_once 'components/header_scripts.php' ?>
	<link rel="stylesheet" href="css/index.css" />
	<link rel="stylesheet" href="css/admin.css" />
	<link rel="stylesheet" href="css/dialog.css" />
	<link rel="stylesheet" href="css/form.css" />
</head>

<body>
	<div class="wrapper">
		<dialog class="dialog">
			<form method="dialog" class="dialog__form">
				<label class="form__row">
					Заголовок:
					<input type="text" placeholder="Введите заголовок статьи..." />
				</label>
				<label class="form__row">
					Текст статьи:
					<textarea placeholder="Введите текст статьи..."></textarea>
				</label>
				<label class="form__row">
					Добавить изображение (необязательно)
					<input type="file" />
				</label>
				<div class="admin__dialog-btns">
					<button value="close" class="btn">Закрыть</button>
					<button value="add" class="btn" id="publicate">
						Опубликовать
					</button>
				</div>
			</form>
		</dialog>
		<div class="content">
			<?php require_once './components/header.php' ?>
			<div class="container">
				<div class="admin">
					<h1 class="admin__title">
						Админ Панель
					</h1>
					<div class="admin__cols">
						<div class="admin__col">
							<div class="admin__col-title">
								Статистика сайта:
							</div>
							<ul class="admin__col-list">
								<li class="admin__col-item">
									- Всего постов:
									<span></span>
								</li>
								<li class="admin__col-item">
									- Новых сегодня:
									<span></span>
								</li>
							</ul>
						</div>
						<div class="admin__col">
							<div class="admin__col-title">
								Быстрые действия:
							</div>
							<ul class="admin__col-list">
								<button id="add-button" class="admin__col-button">
									Добавить пост от лица администратора
								</button>
							</ul>
						</div>
						<div class="admin__col">
							<div class="admin__col-title">
								Удаление постов:
							</div>
							<ul class="admin__col-list delete-list">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'components/footer.php' ?>
	</div>
	<?php require_once 'components/scripts.php' ?>
	<script src="js/utils/dialog.js" type="module"></script>
	<script src="js/addPost.js" type="module"></script>
	<script src="js/admin.js" type="module"></script>
</body>

</html>