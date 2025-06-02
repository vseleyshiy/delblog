<?php
require_once 'jwt.service.php';

function checkAuth()
{
	$header = apache_request_headers();

	// если в запросе на backend нету заголовка Authorization, значит юзер не авторизирован. Возвращаем ошибку на клиет
	if (!isset($header['Authorization'])) {
		message('error', '401 Unauthorized');
	};
}

function getUserId()
{
	$header = apache_request_headers();

	// если в запросе на backend нету заголовка Authorization, значит юзер не авторизирован. Возвращаем ошибку на клиет
	if (!isset($header['Authorization'])) {
		message('error', '401 Unauthorized');
	};

	// если авторизирован, то проверка выше не срабатывает и мы идем сюда

	// забираем токен из заголовка, вырезаем оттуда слово Bearer
	$token = str_replace('Bearer ', '', $header['Authorization']);
	// декодируем при помощи функции класса
	$decode = JwtService::decode($token);

	// забираем из декодированной даты айди
	$id = $decode->id;

	// вощращаем его
	return $id;
}
