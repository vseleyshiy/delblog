<?php
require_once '../db.php';
require_once './auth.dto.php';
require_once __DIR__ . '/../../services/jwt.service.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$header = apache_request_headers();

	// если есть заголовок Authorization, значит пользователь уже авторизирован и ему не нужно делать это снова - выкидываем отсюда error статусом при помощи моей функции message, которая возвращает статус и сообщение, а так же выходит из скрипта при помощи exit, останавливая его
	if (isset($header['Authorization'])) {
		message('error', 'User is already login');
	};

	// Получаем при помощи file_get_contents json информацию, которую мы передали с backend
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);
	// прокидываем через класс данные, которые пришли нам с клиента
	try {
		$user = new LoginDTO($data['email'], $data['password']);
	} catch (Error $e) {
		// если хотя бы один тип не совпадает с типом, который указан в классе возвращаем ошибку на клиент
		message('error', 'Invalid type');
	}

	// забираем в удобные переменные наши данные
	$email = $user->email;
	$password = $user->password;

	// если они пустые, возвращаем ошибку на клиет
	if ($email === '' || $password === '') message('error', 'Some fields is not fullish');

	// дальше ищем юзера с такой почтой
	$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");

	$stmt->bind_param('s', $email);
	$stmt->execute();
	$result = $stmt->get_result();
	// если есть такая почта в бд
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		// проверяем схожесть паролей
		if (password_verify($password, $row['password'])) {
			// если они равны, то убираем пароль, чтобы не отдавать его на клиет, тк это не безопасно
			unset($row['password']);
			// формируем токен для авторизации при помощи id пользователя, который только что авторизировался
			$token = JwtService::issueToken($row['id']);

			// отправляем на клиент статус, данные о юзере (без пароля) и токен, чтобы в дальнейшем записать его в cookie
			echo json_encode(["status" => "success", "data" => $row, 'accessToken' => $token]);
		} else {
			// иначе неверный пароль
			message('error', 'Wrong password');
		}
	} else {
		// иначе юзер не найден
		message('error', 'User not found');
	}
	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a POST request');
}
