<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\Shop\AddToCartForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Добавить';

$this->params['breadcrumbs'][] = ['label' => 'Букеты', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin() ?>

            <?php if ($modifications = $model->modificationsList()): ?>
                <?= $form->field($model, 'modification')->dropDownList($modifications, ['prompt' => '--- Select ---']) ?>
            <?php endif; ?>

            <?= $form->field($model, 'quantity')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>

</div>