<?php
// Единая точка входа API — этот файл обрабатывает все запросы к API


// Устанавливаем заголовок Content-Type для ответа в формате JSON с кодировкой UTF-8
header('Content-Type: application/json; charset=utf-8');


// Разрешаем запросы с любого домена (CORS) — для продакшена лучше указать конкретный домен
header('Access-Control-Allow-Origin: *');


// Разрешённые HTTP-методы для CORS: GET, POST, PUT, DELETE, OPTIONS
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


// Разрешённые заголовки в запросах: Content-Type, Authorization, X-API-Key
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-API-Key');


// Если запрос типа OPTIONS (предзапрос CORS), завершаем скрипт без вывода данных
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(0);


// Получаем метод текущего HTTP-запроса (GET, POST, PUT, DELETE и т.д.)
$method = $_SERVER['REQUEST_METHOD'];


// Извлекаем путь из запроса (например, /api/hello → /api/hello)
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// Получаем только конечную часть пути — имя действия (например, 'hello' из '/api/hello')
$action = basename($path);


// Выбираем логику обработки в зависимости от значения $action
switch ($action) {
   // Обработчик эндпоинта /hello
   case 'hello':
       // Возвращаем простой приветственный ответ в формате JSON
       echo json_encode(['message' => 'Hello, API!', 'method' => $method]);
       break;


   // Обработчик эндпоинта /echo — возвращает полученные данные обратно
   case 'echo':
       // Читаем сырое тело запроса (для POST/PUT с JSON) и декодируем в массив
       $input = json_decode(file_get_contents('php://input'), true);

       // Формируем и выводим ответ с полученными данными, заголовками и методом
       echo json_encode([
           // Если $input пустой, пробуем взять данные из $_GET или $_POST
           'received' => $input ?? $_GET ?? $_POST,
           // Добавляем все заголовки запроса для отладки
           'headers'  => getallheaders(),
           // Указывает, каким методом был сделан запрос
           'method'   => $method
       ]);
       break;


   // Обработчик эндпоинта /date — возвращает текущую дату и время
   case 'date':
       // Возвращаем временну́ю метку, дату, время и часовой пояс сервера
       echo json_encode([
           'timestamp' => time(),                           // Unix-timestamp (секунды с 1970 г.)
           'date'      => date('Y-m-d'),                    // Дата в формате ГГГГ-ММ-ДД
           'time'      => date('H:i:s'),                    // Время в формате ЧЧ:ММ:СС
           'tz'        => date_default_timezone_get()       // Название часового пояса сервера
       ]);
       break;
   // Если $action не совпал ни с одним из известных эндпоинтов
   default:
       // Устанавливаем HTTP-статус 404 (Not Found)
       http_response_code(404);
       // Возвращаем ошибку в формате JSON
       echo json_encode(['error' => 'Endpoint not found']);
}
