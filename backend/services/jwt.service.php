<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
	// функция для получения нового токена
	static function getNewToken($user_id)
	{
		$token = self::issueToken($user_id);

		return $token;
	}

	// функция для создания токена
	static function issueToken($id)
	{
		// дата для токена (кодируем в него id пользователя, а так же назначаем время, через которое он истечёт)
		$accessToken_data = ['id' => $id, 'expiresIn' => time() + (3600 * 24)];

		try {
			// создаем токен при помощи установленной из вне библиотеки при помощи кракозябры в виде JWT_SECRET из .env. Именно только при помощи этой кракозябры можно декодировать токены, потому что при помощи неё мы их и создавали
			$accessToken = JWT::encode($accessToken_data, $_ENV['JWT_SECRET'], 'HS512');
			// возвращаем полученный токен
			return $accessToken;
		} catch (\Throwable $th) {
			// не знаю, что тут может пойти не так, но в документации делают с try -> catch, поэтому если вдруг что, возвращаем сообщение о ошибке
			throw $th->getMessage();
		}
	}

	static function decode($token, $alg = 'HS512')
	{
		try {
			// декодируем токен при помощи того же JWT_SECRET и установленной из вне библиотеки
			$decode = JWT::decode($token, new Key($_ENV['JWT_SECRET'], $alg));
			return $decode;
		} catch (\Throwable $th) {
			// если что-то не так - возвращаем ошибку
			throw $th->getMessage();
		}
	}
}
