<?php
/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */
/* @var $model shop\forms\manage\Shop\Order\OrderEditForm */

use kartik\widgets\DateTimePicker;
use shop\helpers\OrderHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

$this->title = 'Редактировать Заказ: ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="order-update">

    <?php $form = ActiveForm::begin() ?>

    <div class="box box-default">
        <div class="box-header with-border">Статус заказа</div>
        <div class="box-body">
            <?= $form->field($model, 'current_status')->dropDownList(OrderHelper::statusList()) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Дата и время доставки</h3></div>
        <div class="panel-body">
            <?= $form->field($model, 'delivery_datetime')->widget(DateTimePicker::class,
                [
                    'name' => 'delivery_datetime',
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'value' => '',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-mm-yyyy hh:ii'
                    ]
                ]) ?>
        </div>
    </div>
    <!--<div class="box box-default">
        <div class="box-header with-border">Дата и время доставки</div>
        <div class="box-body">
            <?/*=
                DateTimePicker::widget([
                'name' => 'dp_2',
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'value' => date('d-m-Y H:i', $model->delivery_datetime),//
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-mm-yyyy hh:ii'
                ]
            ]); */?>
        </div>
    </div>-->

    <div class="box box-default">
        <div class="box-header with-border">Покупатель</div>
        <div class="box-body">
            <?= $form->field($model->customer, 'name')->textInput() ?>
            <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                'mask' => '+7(999)-999-99-99',
                'options' => [
                    'placeholder' => 'Введите номер телефона'
                ]
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Кому доствить?</div>
        <div class="box-body">
            <?= $form->field($model->recipient, 'name')->textInput() ?>
            <?= $form->field($model->recipient, 'phone')->widget(MaskedInput::class, [
                'mask' => '+7(999)-999-99-99',
                'options' => [
                    'placeholder' => 'Введите номер телефона'
                ]
            ]) ?>
            <?= $form->field($model->recipient, 'address')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Примечания</div>
        <div class="box-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>