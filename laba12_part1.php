<?php
// Функция для записи в log.txt
function writeLog($message) {
    file_put_contents(__DIR__ . '/log.txt', date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL, FILE_APPEND);
}

$messages = [];

// 1. Открытие несуществующего файла
try {
    $file = @fopen('non_existent_file.txt', 'r'); // @ подавляет стандартное предупреждение
    if ($file === false) {
        throw new Exception('Файл "non_existent_file.txt" не найден или не может быть открыт.');
    }
    fclose($file);
    $messages[] = ['text' => 'Файл успешно открыт.', 'type' => 'success'];
} catch (Exception $e) {
    $errorMsg = 'Ошибка открытия файла: ' . $e->getMessage();
    writeLog($errorMsg);
    $messages[] = ['text' => $errorMsg, 'type' => 'error'];
}

// 2. Деление на ноль
try {
    $a = 10;
    $b = 0;
    if ($b == 0) {
        throw new Exception('Попытка деления на ноль.');
    }
    $result = $a / $b;
    $messages[] = ['text' => "Результат деления: $result", 'type' => 'success'];
} catch (Exception $e) {
    $errorMsg = 'Ошибка деления: ' . $e->getMessage();
    writeLog($errorMsg);
    $messages[] = ['text' => $errorMsg, 'type' => 'error'];
}

// 3. Доступ к несуществующему элементу массива
$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
try {
    $key = 'Germany';
    if (!array_key_exists($key, $countries)) {
        throw new Exception("Элемент с ключом '$key' отсутствует в массиве стран.");
    }
    $capital = $countries[$key];
    $messages[] = ['text' => "Столица $key — $capital.", 'type' => 'success'];
} catch (Exception $e) {
    $errorMsg = 'Ошибка доступа к массиву: ' . $e->getMessage();
    writeLog($errorMsg);
    $messages[] = ['text' => $errorMsg, 'type' => 'error'];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная 12 – Обработка исключений</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Дополнительные стили для наглядности */
        .result-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 28px;
        }
        .message {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 16px;
            line-height: 1.4;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 5px solid #17a2b8;
        }
        .log-note {
            margin-top: 20px;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            color: #495057;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .btn-back:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="result-container">
        <h2>🔒 Обработка исключений (try-catch)</h2>
        <?php foreach ($messages as $msg): ?>
            <div class="message <?= htmlspecialchars($msg['type']) ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </div>
        <?php endforeach; ?>
        <div class="log-note">
            📝 Все ошибки записаны в файл <strong>log.txt</strong> в папке скрипта.
        </div>
        <div style="text-align: center;">
            <a href="index.php" class="btn-back">← На главную</a>
        </div>
    </div>
</div>
</body>
</html>
