<?php
require_once '../db.php';
require_once './post.dto.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// получаем дату с клиента
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);

	try {
		// прогоняем через класс, чтобы проверить типы
		$info = new PostDTO($data['id']);
		$post_id = $info->id;
	} catch (Error $e) {
		// если типы не сходятся, отправляем ошибку на клиет
		message('error', 'Invalid type');
	}

	// забираем определенный пост по айди, который передали в body заголовке по методу post. Используем JOIN, чтобы подтянуть имя пользователя для дальнейшей установки на странице поста
	$stmt = $conn->prepare("SELECT posts.id, title, content, created_at, image, name, owner FROM posts JOIN users ON users.id = posts.owner WHERE posts.id = ?");

	$stmt->bind_param('i', $post_id);

	$stmt->execute();

	$result = $stmt->get_result()->fetch_assoc();

	// возвращаем единый уникальный результат
	echo json_encode($result, true);

	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a POST request');
}
