<?php


namespace shop\services\auth;

use shop\repositories\UserRepository;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $mailer;
    private $users;

    public function __construct(MailerInterface $mailer, UserRepository $users)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);

        if(!$user->isActive()){
            throw new \DomainException('User is not Active.');
        }


        $user->requestPasswordReset();

        $this->users->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent){
            throw new \DomainException('Sending error.');
        }

    }

    public function validateToken($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);

        $user->resetPassword($form->password);

        $this->users->save($user);

    }

}
