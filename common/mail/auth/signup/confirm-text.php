<?php

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->verification_token]);
?>
Здравствуйте <?= $user->username ?>,

Перейдите по ссылке ниже для подтверждения эл.почты:

<?= $verifyLink ?>
