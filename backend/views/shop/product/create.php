<?php

use kartik\widgets\FileInput;
//use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\Product\ProductCreateForm */


$this->title = 'Создать товар';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-create">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'brandId')->dropDownList($model->brandsList()) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Склад</div>
        <div class="box-body">
            <div class="row">
                <!--<div class="col-md-6">
                    <?/*= $form->field($model, 'weight')->textInput(['maxlength' => true]) */?>
                </div>-->
                <div class="col-md-6">
                    <?= $form->field($model->quantity, 'quantity')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Цена</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model->price, 'new')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model->price, 'old')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Категории</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main')->dropDownList($list = $model->categories->categoriesList(), ['prompt' => '---Выберите категорию---']) ?>
                    <?= $form->field($model->categories, 'others')->checkboxList($list) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Теги</div>
                <div class="box-body">
                    <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                    <?= $form->field($model->tags, 'textNew')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Характеристики</div>
        <div class="box-body">
            <?php foreach ($model->values as $i => $value): ?>
                <?php if ($variants = $value->variantsList()): ?>
                    <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => '']) ?>
                <?php else: ?>
                    <?= $form->field($value, '[' . $i . ']value')->textInput() ?>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Фотографии</div>
        <div class="box-body">
            <?= $form->field($model->photos, 'files[]')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
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
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>