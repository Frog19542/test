<?php
$baseDir = __DIR__ . '/';

$messages = [];

function addMessage($text, $type = 'success') {
    global $messages;
    $messages[] = ['text' => $text, 'type' => $type];
}

$testDir = $baseDir . 'test';
if (!file_exists($testDir)) {
    if (mkdir($testDir)) {
        addMessage("Папка 'test' создана.", 'success');
    } else {
        addMessage("Не удалось создать папку 'test'.", 'error');
    }
} else {
    addMessage("Папка 'test' уже существует.", 'info');
}

$wwwDir = $baseDir . 'www';
if (file_exists($testDir)) {
    if (rename($testDir, $wwwDir)) {
        addMessage("Папка 'test' переименована в 'www'.", 'success');
    } else {
        addMessage("Не удалось переименовать папку 'test'.", 'error');
    }
} else {
    addMessage("Папка 'test' не найдена для переименования.", 'error');
}

if (file_exists($wwwDir)) {
    $files = array_diff(scandir($wwwDir), ['.', '..']);
    if (empty($files)) {
        if (rmdir($wwwDir)) {
            addMessage("Папка 'www' удалена (была пуста).", 'success');
        } else {
            addMessage("Не удалось удалить папку 'www'.", 'error');
        }
    } else {
        addMessage("Папка 'www' не пуста, удаление невозможно.", 'error');
    }
} else {
    addMessage("Папка 'www' не найдена для удаления.", 'error');
}

if (!file_exists($testDir)) {
    if (mkdir($testDir)) {
        addMessage("Папка 'test' создана заново.", 'success');
    } else {
        addMessage("Не удалось создать папку 'test' повторно.", 'error');
    }
} else {
    addMessage("Папка 'test' уже существует, повторное создание не требуется.", 'info');
}

$folderNames = ['images', 'documents', 'temp', 'backup'];
if (file_exists($testDir)) {
    foreach ($folderNames as $folder) {
        $subDir = $testDir . '/' . $folder;
        if (!file_exists($subDir)) {
            if (mkdir($subDir)) {
                addMessage("Создана подпапка 'test/$folder'.", 'success');
            } else {
                addMessage("Не удалось создать 'test/$folder'.", 'error');
            }
        } else {
            addMessage("Подпапка 'test/$folder' уже существует.", 'info');
        }
    }
} else {
    addMessage("Папка 'test' не найдена, создание подпапок невозможно.", 'error');
}

$jpgFiles = glob($baseDir . '*.jpg');
if (count($jpgFiles) > 0) {
    $list = '<ul>';
    foreach ($jpgFiles as $file) {
        $list .= '<li>' . basename($file) . ' (размер: ' . filesize($file) . ' байт)</li>';
    }
    $list .= '</ul>';
    addMessage("Найденные .jpg файлы в текущей папке:<br>$list", 'info');
} else {
    addMessage("В текущей папке нет файлов с расширением .jpg.", 'info');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа 11 - Часть 2</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .result-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .result-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 28px;
        }
        .message {
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            font-size: 15px;
        }
        .message.success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        .message.info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
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
        ul {
            margin: 10px 0 0 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="result-container">
            <h2>Лабораторная работа 11 (часть 2): Работа с папками</h2>
            <?php foreach ($messages as $msg): ?>
                <div class="message <?= htmlspecialchars($msg['type']) ?>">
                    <?= $msg['text'] ?>
                </div>
            <?php endforeach; ?>
            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php" class="btn-back">← На главную</a>
                <a href="laba11_part2.php" class="btn-back" style="margin-left: 15px;">⟳ Выполнить заново</a>
            </div>
        </div>
    </div>
</body>
</html>
