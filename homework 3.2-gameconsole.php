<?php
require 'Product.php';
class GameConsole extends InternetProduct
{
    private $memorySize;
    static $categoryDiscount = 0;
    static $category = 'GameConsole';
    public function __construct($brand, $model, $quantity, $memorySize)
    {
        parent::__construct($brand, $model, $quantity);
        $this->memorySize = $memorySize;
    }
    static function setCategoryDiscount($categoryDiscount)
    {
        self::$categoryDiscount = $categoryDiscount;
    }
    public function biggerDiscount()
    {

        if ($this->discount < self::$categoryDiscount)
        {
            $this->discount = self::$categoryDiscount;
        }

    }
}
$xbox = new GameConsole('Microsoft', 'One', 20, 32);
$xbox->setPrice(30000)->setDiscount(10);
GameConsole::setCategoryDiscount(15);
echo $xbox->getFinalPrice(), PHP_EOL;