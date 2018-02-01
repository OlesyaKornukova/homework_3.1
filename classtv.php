<?php

class Tv 
{
	private $brand;
	private $model;
	private $screenSize;
	private $smartTv;
	private $screenTechnology;
	private $wallAttach;

	private $status = 'off';
	private $currentChannel = 0;
	private $volumeLevel = 10;
	public $knowWhereIsRemote = true;
	

	function __construct($brand, $model, $size, $technology, $wall = true, $smart = false)
	{ 
		$this->brand = $brand;
		$this->model = $model;
		$this->screenSize = $size;
		$this->screenTechnology = $technology;
		$this->wallAttach = $wall;
		$this->smartTv = $smart;
	}

	public function turnOn()
	{
		$this->status = 'on';
	}

	public function turnOff()
	{
		$this->status = 'off';
	}

	public function switchChannel($num)
	{
		if ( $this->status === 'on')
		{
			$this->currentChannel = $num;
		}
	}

	public function mute()
	{
		if ( $this->status === 'on')
		{
			$this->volumeLevel = 0;
		}
		
	}

	public function setVolume($num)
	{
		if ( $this->status === 'on')
		{
			for($i = 0, $j = abs($this->volumeLevel-$num); $i < $j; $i++)
			{
				if($num > $j)
				{
					$this->volumeLevel++;
				} else
				{
					$this->volumeLevel--;
				}
			}

		}
	}

	public function attachToWall()
	{
		if ( $this->status === 'off' && $this->wallAttach )
		{
			// повесить на стену;
		}
	}



	public function browseTheNet($url)
	{
		if ($this->smartTv && $this->status === 'on')
		{
			echo '<a href="'.$url.'">'.$url.'<a>';
		}
	}

	public function findRemote()
	{
		if ( !$this->knowWhereIsRemote )
		{
			// искать пульт
		}
	}
}

$tv1 = new Tv('Samsung', 'HAK48AKDL', 48, 'LED', true, true);
$tv2 = new Tv('LG', 'jnkdy30', 30, 'tube', false);

$tv1->turnOn();
$tv1->browseTheNet('http://www.yandex.ru');

$tv1->attachToWall();

$tv2->knowWhereIsRemote = false;
$tv2->findRemote();




