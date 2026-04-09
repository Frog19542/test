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
        $this->template = '
            <div class="cards-container">
                <div class="card">
                    <img src="img/foto2.jpg" alt="Корабль" class="card-img">
                    <h3>Уплыть на корабле</h3>
                    <p>Отправьтесь в морское приключение!</p>
                </div>
                <div class="card">
                    <img src="img/foto.jpg" alt="Берег" class="card-img">
                    <h3>Остаться на берегу</h3>
                    <p>Наслаждайтесь спокойствием и пляжем.</p>
                </div>
            </div>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лаба14</title>
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
        .cards-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            width: 280px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.2);
        }
        .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card h3 {
            margin: 15px 0 5px;
            color: #333;
        }
        .card p {
            padding: 0 15px 20px;
            color: #666;
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
                if (isset($_GET['page']) && $_GET['page'] === 'blog') 
                    echo 'Куда отправимся?';
                elseif (isset($_GET['page']) && $_GET['page'] === 'page')
                    echo 'Стандартная страница';
                else 
                    echo 'Добро пожаловать! Выберите страницу выше ↑';
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
                echo '<div class="default-page">Неизвестная страница. Используйте ссылки выше.</div>';
            }
        } else {
            echo '<div class="default-page">Нажмите на одну из ссылок, чтобы увидеть содержимое.</div>';
        }
        ?>
    </div>
</div>
</body>
</html>
