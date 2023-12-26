<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            <h2>Новый покупатель</h2>
            <p><strong>Создайте себе кабинет</strong></p>
            <p>Создав кабинет, вы сможете делать покупки быстрее, будете в курсе статуса заказа и сможете отслеживать заказы, которые вы сделали ранее.</p>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="btn btn-primary">Регистрация</a>
        </div>
        <!--<div class="well">
            <h2>Регистрация через ВК</h2>
            <?/*= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['auth/network/auth']
            ]); */?>
        </div>-->
    </div>
    <div class="col-sm-6">
        <div class="well">
            <h2>Вход покупателя</h2>
            <p><strong>У меня уже создан кабинет</strong></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                Забыли пароль? <?= Html::a('Получить новый пароль', ['auth/reset/request']) ?>.
            </div>
            <div style="color:#999;margin:1em 0">
                Не получили письмо? <?= Html::a('Отправить еще раз', ['auth/resend/resend']) ?>.
            </div>

            <div>
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>