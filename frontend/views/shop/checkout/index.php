<?php
/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderForm */

use kartik\widgets\DateTimePicker;
use shop\helpers\PriceHelper;
//use shop\helpers\WeightHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = 'Заказ - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = 'Заказ';
?>

<div class="cabinet-index">

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="text-left">Название</td>
                <!--<td class="text-left">Артикул</td>-->
                <td class="text-left">Количество</td>
                <td class="text-right">Цена</td>
                <td class="text-right">Итого</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $modification = $item->getModification();
                $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                ?>
                <tr>
                    <td class="text-left">
                        <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    </td>
                    <!--<td class="text-left">
                        <?php /*if ($modification): */?>
                            <?/*= Html::encode($modification->name) */?>
                        <?php /*endif; */?>
                    </td>-->
                    <td class="text-left">
                        <?= $item->getQuantity() ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->getPrice()) ?></td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br />

    <?php $cost = $cart->getCost() ?>
    <table class="table table-bordered">
        <!--<tr>
            <td class="text-right">Цена без скидок:</td>
            <td class="text-right"><?/*= PriceHelper::format($cost->getOrigin()) */?></td>
        </tr>-->
        <tr>
            <td class="text-right">Итого (с учетом скидок):</td>
            <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?></td>
        </tr>
        <!--<tr>
            <td class="text-right">Вес:</td>
            <td class="text-right"><?/*= WeightHelper::format($cart->getWeight()) */?></td>
        </tr>-->
    </table>

    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">Внимание!</h3>
        </div>
        <div class="panel-body">
            <p>Прием заказов и оплата принимается круглосуточно на нашем сайте.<br>Доставка оплаченых заказов осуществляется с 09:00 до 21:00 по местному времени (+6 часов от Московского времени) и не раньше чем через 1 час после оплаты заказа. В праздничные дни ассортимент товара и часы доставки меняются.</p>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['action' => ['shop/checkout']]) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>От кого:</h3></div>
        <div class="panel-body">
            <?= $form->field($model->customer, 'name')->textInput() ?>
            <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                'mask' => '+7(999)-999-99-99',
                'options' => [
                    'placeholder' => 'Введите номер телефона'
                ]
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Дата и время доставки</h3></div>
        <div class="panel-body">
            <?= $form->field($model, 'delivery_datetime')->widget(DateTimePicker::class,
                [
                    'name' => 'delivery_datetime',
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'value' => date('php:d-m-Y H:i', time()),
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-mm-yyyy hh:ii'
                    ]
                ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Кому доставить?</h3></div>
        <div class="panel-body">
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

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Примечания:</h3></div>
        <div class="panel-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ОТПРАВИТЬ ЗАКАЗ', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>