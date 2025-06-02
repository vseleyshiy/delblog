<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Главная | DelBlog</title>
	<?php require_once 'components/header_scripts.php' ?>
	<link rel="stylesheet" href="css/index.css" />
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
					<button value="add" id="publicate" class="btn">
						Опубликовать
					</button>
				</div>
			</form>
		</dialog>
		<div class="content">
			<?php require_once './components/header.php' ?>
			<div class="container">
				<main class="main">
					<div class="main__header">
						<div class="title">Последние записи</div>
					</div>
					<div class="list">
					</div>
				</main>
			</div>
		</div>
		<?php require_once 'components/footer.php' ?>
	</div>
	<?php require_once 'components/scripts.php' ?>
	<script src="js/index.js" type="module"></script>
	<script src="js/utils/dialog.js" type="module"></script>
	<script src="js/addPost.js" type="module"></script>
</body>

</html>