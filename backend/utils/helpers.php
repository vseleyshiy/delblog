<?php
// моя функция для удобной отправки статуса на фронтенд - после использования код на бэкенде останавливается при помощи exit на 10 строке.
function message($status, $message)
{
	$obj = [
		"status" => $status,
		"message" => $message
	];
	print_r(json_encode($obj) . PHP_EOL);
	exit;
}

// функция для убирания из строки html символов и символов, которые применяются для sql injections.
function fix_string($conn, $string)
{
	return htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, $string)));
}
