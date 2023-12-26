<?php


namespace shop\services\auth;


use shop\entities\User\User;
use shop\forms\auth\LoginForm;
use shop\repositories\UserRepository;
use yii\db\ActiveRecord;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param LoginForm $form
     * @return array|User| ActiveRecord
     */
    public function auth(LoginForm $form)
    {
        $user = $this->users->findByUsernameOrEmail($form->username);

        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException( 'Неверное имя или пароль.');
        }
        return $user;
    }
}