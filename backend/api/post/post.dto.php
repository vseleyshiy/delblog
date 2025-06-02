<?php
require_once '../db.php';

// дтошка для проверки айди на число
class PostDTO
{
	public readonly int $id;

	public function __construct($id)
	{
		global $conn;

		$this->id = filter_var(fix_string($conn, $id), FILTER_VALIDATE_INT);
	}
}
