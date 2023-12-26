<?php
namespace shop\forms\Shop\Order;


use yii\base\Model;

class RecipientForm extends Model
{
    public $phone;
    public $name;
    public $address;


    public function rules(): array
    {
        return [
            [['phone', 'name', 'address'], 'required'],
            [['name','phone'], 'string', 'max' => 30],
            ['address', 'string'],
            ['phone', 'match', 'pattern' => '/^\+7\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Не верно введен номер телефона.' ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'address' => 'Адрес получателя в городе Чита',
        ];
    }
}