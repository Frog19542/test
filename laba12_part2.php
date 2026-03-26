<?php
$results = [];

$ts1 = mktime(10, 25, 0, 3, 15, 2025);
$results[] = ['title' => 'Timestamp для 15 марта 2025 10:25:00', 'value' => $ts1];

$date2 = mktime(8, 5, 59, 10, 2, 1990);
$diff = time() - $date2;
$results[] = ['title' => 'Разница (секунд) между 02.10.1990 08:05:59 и сейчас', 'value' => number_format($diff)];

$results[] = ['title' => 'Текущая дата-время', 'value' => date('Y.m.d H:i:s')];

$firstSep = mktime(0, 0, 0, 9, 1);
$results[] = ['title' => '1 сентября текущего года', 'value' => date('Y.m.d', $firstSep)];

$weekDays = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
$dayIndex = date('w', mktime(0, 0, 0, 2, 2, 2000));
$results[] = ['title' => 'День недели 2 февраля 2000 года', 'value' => $weekDays[$dayIndex]];

$results[] = ['title' => 'Сегодня', 'value' => $weekDays[date('w')]];

$birthdayIndex = date('w', mktime(0, 0, 0, 6, 12, 2016));
$results[] = ['title' => '12 июня 2016 года (мой день рождения)', 'value' => $weekDays[$birthdayIndex]];

$compareResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date1'], $_POST['date2'])) {
    $date1 = trim($_POST['date1']);
    $date2 = trim($_POST['date2']);
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);
    if ($ts1 === false || $ts2 === false) {
        $compareResult = '<span style="color:#dc3545;">Ошибка: одна из дат введена неверно.</span>';
    } elseif ($ts1 > $ts2) {
        $compareResult = "Дата <strong>$date1</strong> больше, чем <strong>$date2</strong>.";
    } elseif ($ts1 < $ts2) {
        $compareResult = "Дата <strong>$date2</strong> больше, чем <strong>$date1</strong>.";
    } else {
        $compareResult = "Даты равны.";
    }
}

$original = '2025-12-31';
$converted = date('d-m-Y', strtotime($original));
$results[] = ['title' => "Преобразование '$original' → 'день-месяц-год'", 'value' => $converted];

$date = date_create('2000-02-03');
date_modify($date, '+2 days');
date_modify($date, '+1 month');
date_modify($date, '+3 days');
date_modify($date, '+1 year');
date_modify($date, '-3 days');
$newDate = date_format($date, 'd.m.Y');
$results[] = ['title' => 'Результат операций с датой 03.02.2000 (+2д, +1м, +3д, +1г, -3д)', 'value' => $newDate];

$now = time();
$nextNewYear = mktime(0, 0, 0, 1, 1, date('Y') + 1);
$daysLeft = ceil(($nextNewYear - $now) / (60 * 60 * 24));
$results[] = ['title' => 'Дней до Нового года', 'value' => $daysLeft];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная 12 – Работа с датами</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
        }
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
        .result-item {
            background: #f8f9fa;
            border-left: 5px solid #667eea;
            padding: 12px 15px;
            margin-bottom: 12px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
        }
        .result-title {
            font-weight: 600;
            color: #495057;
        }
        .result-value {
            font-family: monospace;
            font-size: 1.1em;
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 5px;
            color: #212529;
        }
        .compare-form {
            background: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .compare-form form {
            display: flex;
            gap: 10px;
            align-items: flex-end;
            flex-wrap: wrap;
        }
        .compare-form label {
            display: flex;
            flex-direction: column;
            font-size: 0.9em;
        }
        .compare-form input {
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .compare-form button {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .compare-form button:hover {
            background: #218838;
        }
        .compare-result {
            margin-top: 10px;
            padding: 8px;
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            border-radius: 5px;
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
        @media (max-width: 600px) {
            .result-item {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="result-container">
        <h2> Работа с датами</h2>

        <?php foreach ($results as $item): ?>
            <div class="result-item">
                <span class="result-title"><?= htmlspecialchars($item['title']) ?>:</span>
                <span class="result-value"><?= htmlspecialchars($item['value']) ?></span>
            </div>
        <?php endforeach; ?>

        <div class="compare-form">
            <div style="margin-bottom: 8px;"><strong>🔍 Сравнение двух дат</strong></div>
            <form method="post">
                <label>
                    Дата 1 (YYYY-MM-DD):
                    <input type="date" name="date1" required>
                </label>
                <label>
                    Дата 2 (YYYY-MM-DD):
                    <input type="date" name="date2" required>
                </label>
                <button type="submit">Сравнить</button>
            </form>
            <?php if ($compareResult !== null): ?>
                <div class="compare-result">
                     Результат: <?= $compareResult ?>
                </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="btn-back">← На главную</a>
        </div>
    </div>
</div>
</body>
</html>

