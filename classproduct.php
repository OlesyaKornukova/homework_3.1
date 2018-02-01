<?php

class Product
{
	private $category;
	private $brand;
	private $model;
	private $weight;


	private $title;
	private $description;
	private $photo;
	private $price;

	private $discount = 0;
	private $categoryDiscount = 0;
	private $quantityLeft;


	function __construct($category, $brand, $model, $quantity)
	{
		$this->category = $category;
		$this->brand = $brand;
		$this->model =$model;
		$this->quantityLeft = $quantity;
	}

	public function addToCart(&$array, $quantity)
	{
		if ( $this->quantityLeft >= $quantity)
		{
			$array[] = ['Товар' => $this, 'Количество' => $quantity];
			return true;
		} 
		return false; 
	}

	public function setTitle($text)
	{
		$this->title = $text;
	}

	public function setPhoto($photoPath)
	{
		$this->photo = $photoPath;
	}

	public function setDescription($text)
	{
		$this->description = $text;
	}

	public function setPrice($num)
	{
		$this->price = $num;
	}

	public function setDiscount($num)
	{
		$this->discount = $num;
	}

	public function setCategoryDiscount($category, $num)
	{
		if ($this->category === $category)
		{
			$this->categoryDiscount = $num;
		}
		
	}

	public function getPrice()
	{
		if ($this->discount >= $this->categoryDiscount)
		{
			return $this->price * (1 - $this->discount);
		} else
		{
			return $this->price * (1 - $this->categoryDiscount);
		}
		
	}

	public function sell($num)
	{
		if ( $this->quantityLeft > $num  && !empty($this->price) )
		{
			$this->quantityLeft = $this->quantityLeft - $num;
			return $num * $this->price;
		}

		return false;

	}
	
}

$array_cart = array();

$tv = new Product('телевизоры', 'Samsung', 'HFSJANN50', 20);
$phone =new Product('смартфоны', 'Apple', 'iPhone 7', 100);

$phone->setPrice(60000);
$phone->setCategoryDiscount('смартфоны', 0.15);

echo $phone->getPrice();

$tv->addToCart($array_cart, 3);

var_dump($array_cart);

