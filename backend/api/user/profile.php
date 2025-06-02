<?php
require_once '../db.php';
require_once __DIR__ . '/../../services/auth.service.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	// забираем id из токена из Authorization заголовка
	$id = getUserId();

	// ищем данные юзера по айди
	$stmt = $conn->prepare("SELECT id, name, email, is_admin FROM users WHERE id = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$result = $stmt->get_result()->fetch_assoc();

	// возвращаем json на frontend
	echo json_encode($result, true);

	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a GET request');
}
