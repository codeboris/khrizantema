<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset/reset', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->username) ?>,</p>

    <p>Перейдите по ссылке ниже для сброса пароля:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
