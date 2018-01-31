<?php
///////////////////////////////////// Product ////////////////////////////////////
abstract class GeneralInfo
{
    public $brand;
    public $model;
    public $color;
}
interface PricingData
{

    public function getPrice();
    public function getFinalPrice();
    public function setPrice($price);
    public function setDiscount($discount);
}
interface ProductInfo
{
    public function setCategory($category);
    public function setTitle($title);
    public function setPhotoPath($photoPath);
    public function setDescription($description);
}
class Cart
{
    public $cart = [];
    public function addProduct(Product $object, $quantity)
    {
        $this->cart[] = ['Товар' => $object, 'Количество' => $quantity];
    }
}
abstract class Product extends GeneralInfo implements PricingData, ProductInfo
{
    public $price;
    public $discount = 0;
    public $categoryDiscount = 0;
    public $category;
    public $quantityLeft;
    public $title;
    public $description;
    public $photoPath;
    public function addToCart(Cart $object, $quantity)
    {
        $object->addProduct($this, $quantity);
    }
}
///////////////////////////////////// TV ////////////////////////////////////
interface GeneralTvContols
{
    public function turnOn();
    public function turnOff();
    public function switchChannel($num);
    public function mute();
    public function setVolume($num);
}
interface SpecificTvFunctions
{
    public function browseTheNet($url);
    public function openApp($appName);
}
interface physicalTvFunctions
{
    public function attachToWall();
    public function findRemote();
}
///////////////////////////////////// Pen ////////////////////////////////////
interface Writing
{
    public function inkCheck();
    public function write($text);
}
abstract class SimplePen extends GeneralInfo
{
    public $material;
}
///////////////////////////////////// Animal ////////////////////////////////////
abstract class Animal
{
    protected $condition = 'alive';
    public $legsNumber;
    public $skinType;
    protected $sound;
    protected $look;
    protected $swimType;
    public function looksLike()
    {
        if ( $this->condition !== 'alive') return null;
        return $this->look;
    }
    public function swim()
    {
        if ( $this->condition !== 'alive') return null;
        return $this->swimType;
    }
    public function voice()
    {
        if ( $this->condition !== 'alive') return null;
        return $this->sound;
    }
}
abstract class Bird extends Animal
{
    public $wings = true;
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
}
interface WildAnimal
{
    public function getFood();
}
interface HomeAnimal
{
    public function feed($food);
    public function getEggs();
    public function getFeather();
    public function christmasTime();
    public function getInfo();
}
///////////////////////////////////// Vehicle ////////////////////////////////////
abstract class Vehicle extends GeneralInfo implements Driving, SimpleCarSpecifications
{
    public $transmission;
    public $type;
    public $price;
    public function makeService()
    {
        $this->distanceToService = self::SERVICE_DISTANCE;
        $this->expences = $this->expences + self::SERVICE_COST;
        echo 'Вы провели ТО автомобиля и заплатили ' . self::SERVICE_COST . ' рублей. Теперь ваша машина в идеальном состоянии. Следующее ТО через ' . self::SERVICE_DISTANCE . ' километров' . '<br>';
    }
    public function callTowTruck($distance)
    {
        $evacuationCost = (((2 * $distance) ) * (self::FUEL_CONSUMPTION + 3)) * self::FUEL_PRICE + 5000;
        $this->coordinates = ['X' => 0, 'Y' => 0];
        $this->expences = $this->expences + $evacuationCost;
        echo 'Ваша машина была эвакуирована и доставлена в точку с координатами [0;0]. За эвакуацию вы заплатили '.round($evacuationCost, 2).' рублей.' . '<br>';
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
}
interface SimpleCarSpecifications
{
    const SERVICE_DISTANCE = 15000;
    const SERVICE_COST = 15000;
    const FUEL_CONSUMPTION = 10; // на 100 км
    const FUEL_PRICE = 38;
    const GAS_TANK = 50;
}
interface Driving
{
    public function coordinatesChange($X, $Y);
    public function fuelToBurn($distance);
    public function drive($positionX, $positionY);
}

