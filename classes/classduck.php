<?php

class Duck
{
	private $color;
	private $type;
	private $weight;
	private $name;
	private $purpose;

	private $eggsTotal = 0;
	private $featherTotal = 0;
	private $condition = 'alive';

	function __construct($color, $type, $weight, $purpose, $name='')
	{
		$this->color = $color;
		$this->type = $type;
		$this->weight = $weight;
		$this->purpose = $purpose;
		$this->name = $name;

	}

	public function looksLike()
	{
		if ( $this->condition !== 'alive') return null;

		return 'duck';
	}


	public function swim()
	{
		if ( $this->condition !== 'alive') return null;

		return 'swims like duck';
	}

	public function voice()
	{
		if ( $this->condition !== 'alive') return null;

		return 'quack';
	}


	public function duckTest()
	{
		if ( $this->condition !== 'alive') return null;

		if ( $this->looksLike() === 'duck' && $this->swim() === 'swims like duck' && $this->voice() === 'quack' )
		{
			echo 'If it looks like a duck, swims like a duck and quacks like a duck, then it probably is a duck.'.'<br>';
			return true;
		}

		return false;
	}

	public function feed($food)
	{
		if ( $this->condition !== 'alive') return null;

		$this->weight = $this->weight + $food;
		if ( $food > 1000) // граммы корма
		{
			$this->condition = 'dead';
		}
	}

	public function getEggs()
	{
		if ( $this->condition !== 'alive') return null;

		$eggs = rand(1, 6);
		$this->eggsTotal = $this->eggsTotal + $eggs;
		$this->weight = $this->weight - $eggs * 30;
		echo "Собрано $eggs яиц";
	}

	public function getFeather() // пух
	{
		if ( $this->condition !== 'alive') return null;

		$feather = rand(20, 40); // количество перьев может быть 
		$this->weight = $this->weight - $feather;
		$this->featherTotal = $this->featherTotal + $feather;
		echo "Собратно $feather единиц пуха";
	}

	private function kill()
	{
		$this->condition = 'dead';
	}

	public function christmasTime()
	{
		if ( $this->condition !== 'alive') return null;

		date_default_timezone_set('UTC');
		if ( date('d F') === '25 December'){
			$this->kill();
			echo 'На рождественский ужин у нас будет утка!'.'<br>';
			return new ChristmasDinner;
		}

		echo 'Сегодня еще не рождество!'.'<br>';
	}

	public function getInfo()
	{

		if ( !empty($this->name)) echo "Имя: $this->name".'<br>';
		echo "Цвет: $this->color".'<br>';
		echo "Тип: $this->type".'<br>';
		echo "Вес: $this->weight".'<br>';
		echo "Цель разведения: $this->purpose".'<br>';
		echo "Всего собрано яиц: $this->eggsTotal".'<br>';
		echo "Состояние: $this->condition".'<br>';
	}
	
}

class ChristmasDinner
{

}

$duck1 = new Duck('Серый', 'Домашняя', 3000, 'для собирания яиц');
$duck2 = new Duck('Черный', 'Дикая', 4000, 'для охоты');

$duck2->getInfo();
echo '<br>';
$duck2->duckTest();
echo '<br>';
$duck1->getEggs(); 
echo '<br>';
$duck1->getEggs(); 
echo '<br>';
echo $duck1->christmasTime(); 
