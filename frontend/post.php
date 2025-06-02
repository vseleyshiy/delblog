<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Post | DelBlog</title>
	<link rel="stylesheet" href="css/index.css" />
	<link rel="stylesheet" href="css/post.css" />
	<?php require_once 'components/header_scripts.php' ?>
</head>

<body>
	<div class="wrapper">
		<div class="content">
			<?php require_once './components/header.php' ?>
			<div class="container">
				<div class="post">
				</div>
			</div>
		</div>
		<?php require_once 'components/footer.php' ?>
	</div>
	<?php require_once 'components/scripts.php' ?>
	<script src="js/services/post.service.js" type="module"></script>
	<script src="js/post.js" type="module"></script>
</body>

</html>