<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View  */
/* @var $model shop\forms\manage\Blog\TagForm  */
/* @var $form yii\widgets\ActiveForm  */

?>
<div class="tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
