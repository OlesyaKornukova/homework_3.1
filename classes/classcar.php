<?php

class Car
{
	const SERVICE_DISTANCE = 15000;
	const SERVICE_COST = 15000;
	const FUEL_CONSUMPTION = 10; // на 100 км
	const FUEL_PRICE = 38;
	const GAS_TANK = 50;

	private $brand;
	private $model;
	private $transmission;
	private $type;
	private $price;


	private $expences = 0;
	private $distanceToService = self::SERVICE_DISTANCE;
	public $fuelLevel = self::GAS_TANK;
	private $mileage = 0;
	private $coordinates = ['X' => 0, 'Y' => 0];


	function __construct($brand, $model, $transmission, $type, $price)
	{
		$this->brand = $brand;
		$this->model = $model;
		$this->transmission = $transmission;
		$this->type = $type;
		$this->price = $price;
		$this->expences = $this->expences + $price;

		echo "Вы приобрели автомобиль марки $this->brand модели $this->model в кузове $this->type с $this->transmission коробкой передач за $this->price рублей." . '<br>';
	}

	

	private function coordinatesChange($X, $Y)
	{
		$coordinateDifference = ['X' => $this->coordinates['X'] - $X, 'Y' => $this->coordinates['Y'] - $Y];
		$this->coordinates = ['X' => $X, 'Y' => $Y];
		$driveDistance = hypot($coordinateDifference['X'], $coordinateDifference['Y']);
		return $driveDistance;
	}

	private function fuelToBurn($distance)
	{
		return $distance * self::FUEL_CONSUMPTION / 100;
	}

	public function callTowTruck($distance)
	{
		$evacuationCost = (((2 * $distance) ) * (self::FUEL_CONSUMPTION + 3)) * self::FUEL_PRICE + 5000;
		$this->coordinates = ['X' => 0, 'Y' => 0];
		$this->expences = $this->expences + $evacuationCost;

		echo 'Ваша машина была эвакуирована и доставлена в точку с координатами [0;0]. За эвакуацию вы заплатили '.round($evacuationCost, 2).' рублей.' . '<br>';

	}


	public function makeService()
	{
		$this->distanceToService = self::SERVICE_DISTANCE;
		$this->expences = $this->expences + self::SERVICE_COST;

		echo 'Вы провели ТО автомобиля и заплатили ' . self::SERVICE_COST . ' рублей. Теперь ваша машина в идеальном состоянии. Следующее ТО через ' . self::SERVICE_DISTANCE . ' километров' . '<br>';
	}

	public function fillUp($liters)
	{
		$freeSpace = self::GAS_TANK - $this->fuelLevel;
		

		if ( $freeSpace >= $liters)
		{
			$this->fuelLevel = $fuelLevel + $liters;
			$fillUpExpences = $liters * self::FUEL_PRICE;

			echo "Вы заправили бак на $liters литров на общую сумму $fillUpExpences рублей." . '<br>';
		
		} else
		{
			$this->fuelLevel = $this->fuelLevel + $freeSpace;
			$fillUpExpences = $freeSpace * self::FUEL_PRICE;
			echo "Мы не смогли заправить вас на $liters литров из-за ограничений топливного бака. Вы были заправлены до полного бака на " . round($freeSpace, 2).' литров на общую сумму '.round($fillUpExpences, 2).' рублей.' . '<br>';
		}

		$this->expences = $this->expences + $fillUpExpences;
		
	}

	public function drive($positionX, $positionY)
	{
		$maxAvailableDistanceFuel = $this->fuelLevel / self::FUEL_CONSUMPTION * 100;

		$distance = $this->coordinatesChange($positionX, $positionY);
		$burnedFuel = $this->fuelToBurn($distance);


		if ( $maxAvailableDistanceFuel > $this->distanceToService )
		{
			if ( $this->distanceToService < $distance )
			{
				$distance = $this->distanceToService;
				$burnedFuel = $this->fuelToBurn($distance);
				$this->fuelLevel = $this->fuelLevel - $burnedFuel;

				echo 'Вы проехали'. round($distance, 2).' метров и ваша машина сломалась в связи с плохим состоянием.' . '<br>';
				$this->callTowTruck($distance);
				$this->makeService();
				$fail = true;
			}

		} else
		{
			if ( $maxAvailableDistanceFuel < $distance )
			{
				$distance = $maxAvailableDistanceFuel;
				$burnedFuel = $this->fuelToBurn($distance);
				$this->fuelLevel = $this->fuelLevel - $burnedFuel;
				$this->distanceToService = $this->distanceToService - $distance;

				echo 'Вы проехали'. round($distance, 2).' метров и у вас закончилось топливо. Заправок поблизости не было, поэтому вы вызвали эвакуатор' . '<br>';
				$this->callTowTruck($distance);
				$this->fillUp(50);
				$fail = true;
			}
		}


		$this->mileage = $this->mileage + $distance;

		if ( !$fail )
		{
			$this->fuelLevel = $this->fuelLevel - $burnedFuel;
			$this->distanceToService = $this->distanceToService - $distance;
			echo 'Вы приехали в точку с координатами ['.$this->coordinates['X'].';'.$this->coordinates['Y'].']. Вы проехали '.round($distance, 2).' километров и потратили '.round($burnedFuel, 2).' литров топлива.' . '<br>';
		}

	}

	public function getInfo()
	{
		$x = $this->coordinates['X'];
		$y = $this->coordinates['Y'];

		echo "Марка автомобиля: $this->brand". '<br>';
		echo "Модель автомобиля: $this->model". '<br>';
		echo "Коробка передач: $this->transmission". '<br>';
		echo "Тип кузова: $this->type". '<br>';
		echo "Стоимость: $this->price рублей". '<br>';

		echo "Местоположение: [$x;$y]". '<br>';

		echo 'Общий пробег: '. round($this->mileage, 2). ' километров'. '<br>';
		echo 'До следующего ТО: ' .round($this->distanceToService, 2). ' километров'. '<br>';
		echo 'Общий расход: '. round($this->expences, 2).' рублей'. '<br>';
	}
	
}



$bmw = new Car('BMW', 'X5', 'автоматическая', 'кроссовер', 5000000);
echo '<br>';
$mer = new Car ('Mercedes', 'E-class', 'ручная', 'седан', 3000000);
echo '<br>';
$mer->getInfo();
echo '<br>';
$bmw->drive(30,40);
echo '<br>';
$bmw->fillUp(5);
echo '<br>';
$bmw->callTowTruck(50);
echo '<br>';
$bmw->makeService();
echo '<br>';
$bmw->getInfo();
