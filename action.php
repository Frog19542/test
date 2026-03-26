<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $errors = [];

    if (empty($_POST['name'])) {
        $errors[] = "Поле 'Имя' обязательно для заполнения";
    }

    if (empty($_POST['email'])) {
        $errors[] = "Поле 'Email' обязательно для заполнения";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный формат email";
    }

    if (empty($_POST['password'])) {
        $errors[] = "Поле 'Пароль' обязательно для заполнения";
    } elseif (strlen($_POST['password']) < 6) {
        $errors[] = "Пароль должен содержать не менее 6 символов";
    }

    if (empty($_POST['confirm_password'])) {
        $errors[] = "Подтвердите пароль";
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors[] = "Пароли не совпадают";
    }

    if (empty($_POST['gender'])) {
        $errors[] = "Выберите пол";
    }

    if (!isset($_POST['agree'])) {
        $errors[] = "Необходимо согласиться с условиями";
    }

    if (!empty($errors)) {
        echo "<!DOCTYPE html>
        <html lang='ru'>
        <head>
            <meta charset='UTF-8'>
            <title>Ошибка регистрации</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='error-container'>
                <h2>Ошибки регистрации:</h2>
                <ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "  </ul>
                <a href='index.php' class='btn-back'>Вернуться к форме</a>
            </div>
        </body>
        </html>";
        exit;
    }
    echo "<!DOCTYPE html>
    <html lang='ru'>
    <head>
        <meta charset='UTF-8'>
        <title>Регистрация успешна</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class='success-container'>
            <h2>Регистрация успешна!</h2>
            <p>Здравствуйте, " . htmlspecialchars($_POST['name']) . "!</p>
            <p>Ваш email: " . htmlspecialchars($_POST['email']) . "</p>
            <p>Пол: " . htmlspecialchars($_POST['gender']) . "</p>
            <a href='index.php' class='btn-back'>На главную</a>
        </div>
    </body>
    </html>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
    $operation = $_POST['operation'];
    $result = 0;
    $error = '';
    switch ($operation) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            if ($num2 == 0) {
                $error = "Ошибка: деление на ноль невозможно!";
            } else {
                $result = $num1 / $num2;
            }
            break;
        default:
            $error = "Ошибка: неизвестная операция!";
    }
    if ($error) {
        header("Location: index.php?error=" . urlencode($error));
    } else {
        $operations = [
            '+' => '+',
            '-' => '-',
            '*' => '×',
            '/' => '÷'
        ];
        $resultText = "Результат: " . $num1 . " " . $operations[$operation] . " " . $num2 . " = " . $result;
        header("Location: index.php?result=" . urlencode($resultText));
    }
    exit;
}

	header("Location: index.php");
	exit;
?>
