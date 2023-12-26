<?php
namespace shop\forms\Shop\Order;


use shop\entities\User\User;
use Yii;
use yii\base\Model;

class CustomerForm extends Model
{

    public $name;
    public $phone;

    public function __construct($config = [])
    {
        /** @var User $user */
        if ($user = Yii::$app->user->identity){
            $this->name = $user->username;
            $this->phone = $user->phone;
        }
        parent::__construct($config);

    }


    public function rules(): array
    {
        return [
            [['phone', 'name'], 'required'],
            [['name','phone'], 'string', 'max' => 30],
            ['phone', 'match', 'pattern' => '/^\+7\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Не верно введен номер телефона.' ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'name' => 'Имя',
        ];
    }
}