<?php
namespace shop\services\auth;
use shop\entities\User\User;
use shop\forms\auth\ResendVerificationEmailForm;
use yii\mail\MailerInterface;

class ResendService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function resend(ResendVerificationEmailForm $form):void
    {
        $user = User::findOne([
            'email' => $form->email,
            'status' => User::STATUS_WAIT
        ]);

        if (!$user){
            throw new \RuntimeException('Пользователь не найден.');
        }

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Подтверждение регистрации на хризантема.ру для  ' . \Yii::$app->name)
            ->send();

        if (!$sent){
            throw new \DomainException('Ошибка отправки почты.');
        }
    }
}
