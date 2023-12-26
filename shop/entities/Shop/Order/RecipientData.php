<?php
namespace shop\entities\Shop\Order;

class RecipientData
{
    public $phone;
    public $name;
    public $address;

    public function __construct($phone, $name, $address)
    {
        $this->phone = $phone;
        $this->name = $name;
        $this->address = $address;
    }
}