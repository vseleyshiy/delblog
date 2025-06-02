<?php
// файл с подключением env файла, а так же соединения с базой данных
// autoload нужен, чтобы работал наш vendor, в котором установлены библиотеки для создания токена при авторизации и подключения .env данных к нашему проекту
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv as Dotenv;

// создаем "соединение" с .env файлом, где назходятся все нуджные нам файлы конфигурации
$dotenv = Dotenv::createImmutable(__DIR__ . '\..');
// грузим .env
$dotenv->load();

// импортируем нужные заголовки для защиты от лишних запросов в наш проект. Там и CORS, и разрешенные заголовки, и разрешенные методы
require_once __DIR__ . '/../utils/headers.php';

$servername = $_ENV['DB_HOSTNAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Ошибка подключения, ошибка: ' . $conn->connect_error);
}

require_once __DIR__ . '/../utils/helpers.php';
