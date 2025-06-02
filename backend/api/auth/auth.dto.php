<?php
require_once '../db.php';

// класс для проверки типов приходящих данных
// это для логина
class LoginDTO
{
	public readonly string $email;
	public readonly string $password;

	public function __construct($email, $password)
	{
		global $conn;

		$this->email = filter_var(fix_string($conn, $email), FILTER_VALIDATE_EMAIL);
		$this->password = fix_string($conn, $password);
	}
}
// это для регистрации
class RegDTO
{
	public readonly string $name;
	public readonly string $email;
	public readonly string $password;

	public function __construct($name, $email, $password)
	{
		global $conn;

		$this->name = fix_string($conn, $name);
		$this->email = filter_var(fix_string($conn, $email), FILTER_VALIDATE_EMAIL);
		$this->password = fix_string($conn, $password);
	}
}
