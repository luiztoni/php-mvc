<?php

namespace Demo\PhpMvc\Models; 

class Product
{
    private $id;
    private $name;
    private $price;

    public function __construct($id = null, $name, $price)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setPrice($price);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        if (!$name || strlen($name) < 3) {
            throw new InvalidArgumentException("Name invalid.");
        }
        $this->name = $name;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        if ($price <= 0) {
            throw new InvalidArgumentException("Price invalid.");
        }
        $this->price = $price;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
}
