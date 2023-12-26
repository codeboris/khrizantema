<?php


namespace shop\services\auth;


use shop\access\Rbac;
use shop\entities\User\User;
use shop\repositories\UserRepository;
use shop\forms\auth\SignupForm;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;
    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        MailerInterface $mailer,
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->mailer = $mailer;
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->transaction->wrap(function () use ($user){
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Регистрация на хризантема.ру')
            ->send();

        if (!$sent){
            throw new \DomainException('Ошибка отправки почты.');
        }


    }

    public function confirm($token):void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Вы не запрашивали подтверждение эл.адреса.');
        }

        $user = $this->users->getByEmailConfirmToken($token);

        $user->verifyEmail();

        $this->users->save($user);

    }
}