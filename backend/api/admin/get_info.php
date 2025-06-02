<?php
require_once '../db.php';
require_once __DIR__ . '/../../services/auth.service.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	// проверяем заголовок Authorization в запросе
	checkAuth();

	$stmt = $conn->prepare("SELECT (SELECT COUNT(*) FROM posts) as all_posts_count, COUNT(*) AS today_posts_count FROM `posts` WHERE created_at >= CURRENT_DATE() - INTERVAL 1 DAY");

	$stmt->execute();

	$result = $stmt->get_result()->fetch_assoc();

	echo json_encode($result, true);

	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a GET request');
}
