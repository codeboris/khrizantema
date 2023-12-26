<?php
namespace shop\forms\manage\Shop\Order;

use shop\entities\Shop\Order\Order;
use yii\base\Model;

class RecipientForm extends Model
{
    public $phone;
    public $name;
    public $address;

    public function __construct(Order $order, array $config = [])
    {
        $this->phone = $order->recipientData->phone;
        $this->name = $order->recipientData->name;
        $this->address = $order->recipientData->address;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'name', 'address'], 'required'],
            [['phone', 'name', 'address'], 'string', 'max' => 255],
        ];
    }
}