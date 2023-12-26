<?php
namespace shop\forms\Shop\Order;


use shop\entities\Shop\Order\Order;
use shop\forms\CompositeForm;


//@property DeliveryForm $delivery
/**
 * @property CustomerForm $customer
 * @property RecipientForm $recipient
 */
class OrderForm extends CompositeForm
{
    public $delivery_datetime;
    public $note;

    public function __construct(array $config = [])
    {
        //$this->delivery = new DeliveryForm($weight);

            $this->customer = new CustomerForm();
            $this->recipient = new RecipientForm();

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['delivery_datetime', 'required'],
            [['delivery_datetime'], 'timeDeliveryValidator'],
            [['note'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'delivery_datetime' => 'Выберите дату и время доставки',
            'note' => 'Укажите дополнительную информацию',
        ];
    }

    public function timeDeliveryValidator($attribute, $params)
    {

        $start_work = "09:00";
        $end_work = "21:00";
        $delivery_datetime = (int)strtotime($this->delivery_datetime);
        $delivery_date = date('d-m-Y', $delivery_datetime);
        $delivery_datetime_start_work = (int)strtotime($delivery_date . " " . $start_work);
        $delivery_datetime_end_work = (int)strtotime($delivery_date . " " . $end_work);



        if ($delivery_datetime < time()) {
            $this->addError($attribute, 'Вы не можете установить дату прошлого времени.');
        }elseif($delivery_datetime < (time() + 3600)){
            $this->addError($attribute, 'Вы не можете установить время раньше чем за 1 час до обработки заказа.');
        }elseif($delivery_datetime < $delivery_datetime_start_work || $delivery_datetime > $delivery_datetime_end_work){
            $this->addError($attribute, 'Доставка осуществляется с 09 часов до 21 часа по местному времени (+06 часов от МСК).');
        }

    }

    protected function internalForms(): array
    {
        return ['recipient', 'customer'];
    }
}