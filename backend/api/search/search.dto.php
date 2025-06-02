<?php
require_once '../db.php';

// дто для проверки запроса в поиске постов на строку
class SearchDTO
{
	public readonly string $text;

	public function __construct($text)
	{
		global $conn;

		$this->text = fix_string($conn, $text);
	}
}
