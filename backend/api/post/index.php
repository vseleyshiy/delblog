<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	// запрос на выборку всех постов вместе с JOIN
	$stmt = $conn->prepare("SELECT posts.id, title, content, created_at, image, name FROM posts JOIN users ON users.id = posts.owner ORDER BY posts.id DESC");

	$stmt->execute();

	$result = $stmt->get_result();

	$data = [];

	if ($result->num_rows > 0) {
		// перебираем ответ, потому что мы выбираем все посты, а не единственный - их будет много
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}
	// возвращем на frontend в виде json
	echo json_encode($data, true);

	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a GET request');
}
