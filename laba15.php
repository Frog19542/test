<?php
declare(strict_types=1);

interface FigureInterface {
    public function getArea(): float;
}

abstract class Figure implements FigureInterface {
    protected float $area;
    protected string $color;
    protected int $sidesCount;

    public function __construct(string $color) {
        $this->color = $color;
    }

    abstract public function infoAbout(): string;

    public function getArea(): float {
        return $this->area;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getSidesCount(): int {
        return $this->sidesCount;
    }
}

class Rectangle extends Figure {
    private float $a;
    private float $b;

    public function __construct(string $color, float $a, float $b) {
        parent::__construct($color);
        $this->a = $a;
        $this->b = $b;
        $this->sidesCount = 4;
        $this->area = $this->calculateArea();
    }

    private function calculateArea(): float {
        return $this->a * $this->b;
    }

    public function getArea(): float {
        return $this->area;
    }

    public function infoAbout(): string {
        return "Это класс прямоугольника. У него {$this->sidesCount} стороны (длины сторон: {$this->a} и {$this->b}).";
    }
}

class Square extends Figure {
    private float $a;

    public function __construct(string $color, float $a) {
        parent::__construct($color);
        $this->a = $a;
        $this->sidesCount = 4;
        $this->area = $this->calculateArea();
    }

    private function calculateArea(): float {
        return $this->a * $this->a;
    }

    public function getArea(): float {
        return $this->area;
    }

    public function infoAbout(): string {
        return "Это класс квадрата. У него {$this->sidesCount} стороны (длина стороны: {$this->a}).";
    }
}


class Triangle extends Figure {
    private float $a;
    private float $b;
    private float $c;

    public function __construct(string $color, float $a, float $b, float $c) {
        parent::__construct($color);
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->sidesCount = 3;
        $this->area = $this->calculateArea();
    }

    private function calculateArea(): float {
        $p = ($this->a + $this->b + $this->c) / 2;
        return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
    }

    public function getArea(): float {
        return $this->area;
    }

    public function infoAbout(): string {
        return "Это класс треугольника. У него {$this->sidesCount} стороны (длины сторон: {$this->a}, {$this->b}, {$this->c}).";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лaба 15</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .figure-card {
            background: #f8f9fa;
            border-left: 5px solid #667eea;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
        }
        .figure-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
        }
        .info {
            color: #555;
            margin: 8px 0;
        }
        .area {
            font-weight: bold;
        }
        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="result-container">
        <h2>Лаба 15</h2>

        <?php
        $rect1 = new Rectangle("Красный", 5, 10);
        $rect2 = new Rectangle("Синий", 3.5, 7.2);

        $square1 = new Square("Зеленый", 4);
        $square2 = new Square("Желтый", 6.5);

        $tri1 = new Triangle("Оранжевый", 3, 4, 5);
        $tri2 = new Triangle("Фиолетовый", 5, 5, 6);

        $objects = [
            'Прямоугольники' => [$rect1, $rect2],
            'Квадраты' => [$square1, $square2],
            'Треугольники' => [$tri1, $tri2]
        ];
        ?>

        <?php foreach ($objects as $type => $figures): ?>
            <h3><?= $type ?></h3>
            <?php foreach ($figures as $index => $figure): ?>
                <div class="figure-card">
                    <div class="figure-title">Фигура <?= $index + 1 ?></div>
                    <div class="info"><?= $figure->infoAbout() ?></div>
                    <div class="info">Цвет: <?= $figure->getColor() ?></div>
                    <div class="area">Площадь: <?= round($figure->getArea(), 2) ?> кв. ед.</div>
                </div>
            <?php endforeach; ?>
            <hr>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
