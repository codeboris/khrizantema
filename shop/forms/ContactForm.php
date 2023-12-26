<?php

namespace shop\forms;


use shop\entities\User\User;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    private $user;

    public function __construct(User $user = null,$config = [])
    {
        if ($user){
            $this->name = $user->username;
            $this->email = $user->email;
        }
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Адрес эл.почты',
            'subject' => 'Тема',
            'body' => 'Текст',
            'verifyCode' => 'Введите код с картинки',
        ];
    }
}
