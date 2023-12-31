<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View  */
/* @var $model shop\forms\manage\Shop\CategoryForm  */
/* @var $form yii\widgets\ActiveForm  */

?>
<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList()) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO-для продвижения</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
