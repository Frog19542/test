<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа 10 - Формы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Регистрация</h2>
            <form action="action.php" method="POST">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" id="name" name="name" placeholder="Введите имя" required>
                </div>
                <div class="form-group">
                    <label for="email">Почта:</label>
                    <input type="email" id="email" name="email" placeholder="name@example.ru" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Подтвердите пароль:</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Повторите пароль" required>
                </div>
                <div class="form-group">
                    <label for="gender">Пол:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Выберите пол</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                        <option value="other">Другой</option>
                    </select>
                </div>
                <div class="form-group checkbox-group">
                    <label>
                        <input type="checkbox" name="agree" required>
                        Создавая учетную запись, вы соглашаетесь с нашими Условиями и конфиденциальностью
                    </label>
                </div>
                <button type="submit" class="btn-submit">Зарегистрироваться</button>
            </form>
        </div>



        <div class="calculator-container">
            <h2>Калькулятор</h2>
            <form action="action.php" method="POST" class="calculator-form">
                <div class="calculator-inputs">
                    <input type="number" name="num1" step="any" required placeholder="Первое число">
                    <input type="number" name="num2" step="any" required placeholder="Второе число">
                </div>
                <div class="calculator-buttons">
                    <button type="submit" name="operation" value="+" class="calc-btn">+</button>
                    <button type="submit" name="operation" value="-" class="calc-btn">-</button>
                    <button type="submit" name="operation" value="*" class="calc-btn">*</button>
                    <button type="submit" name="operation" value="/" class="calc-btn">/</button>
                </div>
            </form>
            <?php
            if (isset($_GET['result'])) {
                echo '<div class="result">' . htmlspecialchars($_GET['result']) . '</div>';
            }
            if (isset($_GET['error'])) {
                echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
