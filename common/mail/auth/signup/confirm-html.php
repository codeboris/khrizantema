<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Здравствуйте <?= Html::encode($user->username) ?>,</p>

    <p>Перейдите по ссылке ниже для подтверждения эл.почты:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
