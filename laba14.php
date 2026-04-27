<?php
declare(strict_types=1);

class Page {
    private string $name = 'page';
    private string $template = '<div><p>It is a default page</p></div>';

    public function render(): void {
        echo $this->template;
    }
}

class BlogPage extends Page {
    public function __construct() {
        $this->name = 'blog';
    }

    public function render(): void {
        if (isset($_GET['choice'])) {
            $choice = $_GET['choice'];
            if ($choice === 'beach') {
                echo '
                <div class="result-card">
                    <img src="/img/foto.png" alt="Пляж" class="result-img">
                    <h3>Отдых на пляже</h3>
                    <p>Вы выбрали пляж. Наслаждайтесь солнцем и песком!</p>
                    <a href="?page=blog" class="back-btn">← Вернуться к выбору</a>
                </div>';
            } elseif ($choice === 'sea') {
                echo '
                <div class="result-card">
                    <img src="/img/foto2.png" alt="Корабль" class="result-img">
                    <h3>Морское путешествие</h3>
                    <p>Вы выбрали море. Вас ждут приключения на корабле!</p>
                    <a href="?page=blog" class="back-btn">← Вернуться к выбору</a>
                </div>';
            } else {
                $this->showChoiceButtons();
            }
        } else {
            $this->showChoiceButtons();
        }
    }

    private function showChoiceButtons(): void {
        echo '
        <div class="buttons-container">
            <a href="?page=blog&choice=beach" class="choice-btn beach-btn">🏖️ На пляж</a>
            <a href="?page=blog&choice=sea" class="choice-btn sea-btn">🌊 В море</a>
        </div>
        <div class="info-message">Выберите направление, чтобы увидеть картинку и описание.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лаба14 – Выбор направления</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { max-width: 1000px; margin: 20px auto; padding: 0 20px; }
        .links { text-align: center; margin: 30px 0; }
        .links a {
            display: inline-block;
            margin: 0 15px;
            padding: 12px 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        .links a:hover { transform: translateY(-3px); }
        .content {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .buttons-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin: 20px 0;
        }
        .choice-btn {
            flex: 1;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .beach-btn {
            background: #f8d5a3;
            color: #b45f1b;
            border: 2px solid #e0a878;
        }
        .beach-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            background: #f5c47a;
        }
        .sea-btn {
            background: #a3d0f8;
            color: #0a4b6e;
            border: 2px solid #6ba5d9;
        }
        .sea-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            background: #7bb9f0;
        }
        .info-message {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: #d1ecf1;
            color: #0c5460;
            border-radius: 8px;
        }
        .result-card {
            text-align: center;
            padding: 20px;
        }
        .result-img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .back-btn:hover {
            background: #5a67d8;
        }
        .default-page {
            font-size: 1.2rem;
            text-align: center;
            padding: 40px;
            background: #e7f3ff;
            border-radius: 10px;
        }
        h2 { text-align: center; color: #667eea; }
    </style>
</head>
<body>
<div class="container">
    <div class="links">
        <a href="?page=page">Обычная страница</a>
        <a href="?page=blog">Блог – выбор места</a>
    </div>
    <div class="content">
        <h2>
            <?php 
                if (isset($_GET['page']) && $_GET['page'] === 'blog') {
                    if (isset($_GET['choice'])) {
                        echo ($_GET['choice'] === 'beach') ? '🏖️ Пляжный отдых' : '🌊 Морское путешествие';
                    } else {
                        echo 'Куда отправимся?';
                    }
                } elseif (isset($_GET['page']) && $_GET['page'] === 'page') {
                    echo 'Стандартная страница';
                } else {
                    echo 'Добро пожаловать! Выберите страницу выше ↑';
                }
            ?>
        </h2>
        <?php
        if (isset($_GET['page'])) {
            if ($_GET['page'] === 'page') {
                $page = new Page();
                $page->render();
            } elseif ($_GET['page'] === 'blog') {
                $blog = new BlogPage();
                $blog->render();
            } else {
                echo '<div class="default-page">Неизвестная страница.</div>';
            }
        } else {
            echo '<div class="default-page">✨ Нажмите на одну из ссылок выше.</div>';
        }
        ?>
    </div>
</div>
</body>
</html>
