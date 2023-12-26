<?php


namespace shop\forms\manage\User;


use shop\entities\User\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserEditForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $role;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        $this->role = $roles ? reset($roles)->name : null;
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['username', 'email', 'role'], 'required'],
            ['email', 'email'],
            [['email', 'phone'], 'string', 'max' => 256],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
            ['phone', 'match', 'pattern' => '/^\+7\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Не верно введен номер телефона.' ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'Адрес эл.почты',
            'phone' => 'Телефон',
        ];
    }

    public function rolesList(): array
    {
        return  ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

}