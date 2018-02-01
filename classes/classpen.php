<?php

class Pen
{
	private $color;
	private $type;
	private $purpose;
	private $price;

	function __construct($price, $color='blue', $type='шариковая', $purpose='для письма')
	{
		$this->price = $price;
		$this->color = $color;
		$this->type = $type;
		$this->purpose = $purpose;
	}

	public function inkCheck()
	{
		$simb = rand(65, 90);

		echo '<p style=color:'.$this->color.'>~~~~<p>';
	}

	public function write($text)
	{
		echo '<p style=color:'.$this->color.'>'.($text).'<p>';
	}
	
}

$teacherPen = new Pen(30, 'red', 'гелевая');

$studentPen = new Pen(20);

$presentPen = new Pen(7000, 'black', 'ручка-паркер', 'для подарка');

$teacherPen->inkCheck();

$presentPen->write('Это дорогая подарочная ручка-паркер');
