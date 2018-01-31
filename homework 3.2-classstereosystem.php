<?php
require 'Product.php';
class StereoSystem extends InternetProduct
{
    private $soundPower;
    private $weight;
    static $categoryDiscount = 0;
    static $category = 'StereoSystem';
    public function __construct($brand, $model, $quantity, $soundPower, $weight)
    {
        parent::__construct($brand, $model, $quantity);
        $this->soundPower = $soundPower;
        $this->weight = $weight;
    }
    protected function checkWeight()
    {
        if ($this->weight > 10)
        {
            return true;
        } else
        {
            return false;
        }
    }
    public function setDiscount($discount)
    {
        if ($this->checkWeight())
        {
            parent::setDiscount($discount);
        }
        return $this;
    }
    public function biggerDiscount()
    {
        if ($this->checkWeight())
        {
            if ($this->discount < self::$categoryDiscount)
            {
                $this->discount = self::$categoryDiscount;
            }
        }
    }
    static function setCategoryDiscount($categoryDiscount)
    {
        self::$categoryDiscount = $categoryDiscount;
    }
}
$stereo = new StereoSystem('Bose', 'eg3r42a', 7, 30, 11);
$stereo->setPrice(7000)->setDiscount(10);
StereoSystem::setCategoryDiscount(15);
echo $stereo->getFinalPrice();
