<?php

// Машина
class CarProp
{
    public $mark;
    public $model;
    public $color;
}

class Car extends CarProp
{
    public function getCar()
    {
        $html = $this->mark . ' ' . $this->model . ' ' . $this->color;
        return $html;
    }
}
$сarAudi = new Car();
$сarAudi->mark = 'Audi';
$сarAudi->model = 'R8';
$сarAudi->color = 'red';

$сarBMV = new Car();
$сarBMV->mark = 'BMV';
$сarBMV->model = 'X5';
$сarBMV->color = 'black';



// Телевизор
class TV
{
    public $mark;
    public $resolution;
    public $diagonal;

    public function getTV()
    {
        echo $this->mark . ' ' . $this->resolution . ' ' . $this->diagonal;
    }
}
$tvLG = new TV();
$tvLG->mark = 'LG';
$tvLG->resolution = '4K';
$tvLG->diagonal = 'black';

$tvSony = new TV();
$tvSony->mark = 'Sony';
$tvSony->resolution = 'FULL HD';
$tvSony->diagonal = 'white';



// Шариковая ручка
class BallpointPen
{
    public $mark;
    public $collection;
    public $color;

    public function getPen()
    {
        echo $this->mark . ' ' . $this->collection . ' ' . $this->color;
    }
}
$penParker = new BallpointPen();
$penParker->mark = 'Parker';
$penParker->collection = 'Jotter';
$penParker->color = 'blue';

$penPero = new BallpointPen();
$penPero->mark = 'Pero';
$penPero->collection = 'Caran';
$penPero->color = 'red';



// Утка
class Duck
{
    public $breed;
    public $dwelling;

    public function getDuck()
    {
        echo $this->breed . ', обитание: ' . $this->dwelling;
    }
}
$duckPekin = new Duck();
$duckPekin->breed = 'Пекинская утка';
$duckPekin->dwelling = 'Китай';

$duckRussia = new Duck();
$duckRussia->breed = 'Русская утка';
$duckRussia->dwelling = 'Россия';

// Товар
class Goods
{
    public $name;
    public $category;
    public $price;

    public function getGoods()
    {
        echo $this->name . ' ' . $this->category . '' . $this->price;
    }
}
$goodsApple = new Goods();
$goodsApple->name = 'iPhone';
$goodsApple->category = 'Телефон';
$goodsApple->price = 25000;

$goodsSamsyng = new Goods();
$goodsSamsyng->name = 'Samsung S8';
$goodsSamsyng->category = 'Телефон';
$goodsSamsyng->price = 24000;

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>
<?=$сarBMV->getCar();?>

</body>
</html>



