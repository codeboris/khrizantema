<?php
namespace shop\forms\manage\Shop\Order;

use shop\entities\Shop\Order\Order;
use shop\forms\CompositeForm;

//@property DeliveryForm $delivery
/**
 * @property CustomerForm $customer
 * @property RecipientForm $recipient
 */

class OrderEditForm extends CompositeForm
{
    public $delivery_datetime;
    public $note;
    public $current_status;

    public function __construct(Order $order, array $config = [])
    {
        $this->delivery_datetime = date('d-m-Y H:i', $order->delivery_datetime);
        $this->note = $order->note;
        $this->current_status = $order->current_status;
        //$this->delivery = new DeliveryForm($order);
        $this->customer = new CustomerForm($order);
        $this->recipient = new RecipientForm($order);
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['delivery_datetime', 'required'],
            ['delivery_datetime', 'date', 'format' => 'php:d-m-Y H:i'],
            ['current_status', 'integer'],
            [['note'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'delivery_datetime' => 'Выберите дату и время доставки',
            'current_status' => 'Текущий статус',
            'note' => 'Укажите дополнительную информацию'
        ];
    }

    protected function internalForms(): array
    {
        return ['recipient', 'customer'];
    }
}