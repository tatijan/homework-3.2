<?php
require 'interfaces.php';
class InternetProduct extends Product
{
    public function __construct($brand, $model, $quantity)
    {
        $this->brand = $brand;
        $this->model =$model;
        $this->quantityLeft = $quantity;
        $this->deliveryCost;
    }
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    public function setPhotoPath($photoPath)
    {
        $this->photo = $photoPath;
        return $this;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }
    public function getDeliveryCost()
    {
        $this->checkDeliveryCost();
        return $this->deliveryCost;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getFinalPrice()
    {
        $this->biggerDiscount();
        return $this->price * (1 - $this->discount / 100);
    }
    public function checkDeliveryCost()
    {
        if($this->hasDiscount())
        {
            $this->deliveryCost = 250;
        } else
        {
            $this->deliveryCost = 300;
        }
    }
    protected function hasDiscount()
    {
        if ($this->discount > 0) return true; else return false;
    }
    public function biggerDiscount(){}
    static function setCategoryDiscount($categoryDiscount){}
}