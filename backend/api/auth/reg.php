<?php
require_once '../db.php';
require_once './auth.dto.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$header = apache_request_headers();

	// если есть заголовок Authorization, значит пользователь уже авторизирован и ему не нужно делать это снова - выкидываем отсюда error статусом при помощи моей функции message, которая возвращает статус и сообщение, а так же выходит из скрипта при помощи exit, останавливая его
	if (isset($header['Authorization'])) {
		message('error', 'User is already login');
	};

	// Получаем при помощи file_get_contents json информацию, которую мы передали с backend
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);
	try {
		// прокидываем через класс данные, которые пришли нам с клиента
		$user = new RegDTO($data['name'], $data['email'], $data['password']);
	} catch (Error $e) {
		// если хотя бы один тип не совпадает с типом, который указан в классе возвращаем ошибку на клиент
		message('error', 'Invalid type');
	}

	// забираем в удобные переменные наши данные
	$name = $user->name;
	$email = $user->email;
	$password = $user->password;

	// если они пустые, возвращаем ошибку на клиет
	if ($name === '' || $email === '' || $password === '') message('error', 'Some fields is not fullish');

	// хешируем пароль
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// добавляем запись в бд
	$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

	$stmt->bind_param('sss', $name, $email, $hashed_password);

	try {
		if ($stmt->execute()) {
			// если ок, то отправляем ответ со статусом
			message('success', 'Success create user');
		}
	} catch (ArithmeticError | Exception $e) {
		// иначе юзер уже зарегистрирован
		message('error', 'User already exists');
	}
	$stmt->close();
	$conn->close();
} else {
	message('error', 'This is not a POST request');
}
