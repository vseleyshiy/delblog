<?php
require_once '../db.php';
require_once './search.dto.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// получаем дату с клиента
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);

	try {
		// прогоняем через класс для проверки типов
		$info = new SearchDTO($data['text']);
		// забираем текст
		$text = $info->text;
	} catch (Error $e) {
		// если типы не сходятся - возвращаем ошибку
		message('error', 'Invalid type');
	}

	// запрос с LIKE для нахождения постов по полю title
	$stmt = $conn->prepare("SELECT * FROM `posts` WHERE title LIKE ?");

	// добавляем знаки процента, чтобы поиск был обширнее с обоих сторон приходящего текста
	$text = '%' . $text . '%';

	$stmt->bind_param('s', $text);

	$stmt->execute();

	$result = $stmt->get_result();

	$data = [];

	// результатов может быть несколько, поэтому перебираю
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}

	// возвращаю json на frontend
	echo json_encode($data, true);

	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a POST request');
}
