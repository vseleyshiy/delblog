<?php
require_once '../db.php';
require_once './post.dto.php';
require_once __DIR__ . '/../../services/auth.service.php';

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
	// проверяем авторизацию
	checkAuth();
	// получаем данные
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);

	try {
		// прокидываем через класс, чтобы проверить типы
		$info = new PostDTO($data['id']);
		$post_id = $info->id;
	} catch (Error $e) {
		// при неудаче возвращаем ошибку на клиет
		message('error', 'Invalid type');
	}

	// удаляем запись по айди
	$stmt = $conn->prepare("DELETE FROM `posts` WHERE id = ?");

	$stmt->bind_param('i', $post_id);

	if ($stmt->execute()) {
		// возвращаем успешный статуус
		message('success', 'Post deleted success');
	}

	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a PUT request');
}
