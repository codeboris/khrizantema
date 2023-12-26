<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\User\UserEditForm */
/* @var $user shop\entities\User\User */


$this->title = 'Редактирование данных пользователя ' . $user->username . ' - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование данных пользователя ' . $user->username;
?>
<div class="user-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
        'mask' => '+7(999)-999-99-99',
        'options' => [
            'placeholder' => 'Введите номер телефона'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
