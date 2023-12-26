<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View  */
/* @var $model shop\forms\manage\Shop\Product\ModificationForm  */
/* @var $form yii\widgets\ActiveForm  */

?>
<div class="modification-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
