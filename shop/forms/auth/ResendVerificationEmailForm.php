<?php


namespace shop\forms\auth;

use shop\entities\User\User;
use yii\base\Model;

class ResendVerificationEmailForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_WAIT],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Адрес эл.почты',
        ];
    }
}
