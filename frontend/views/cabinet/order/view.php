<?php
use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */

$this->title = 'Заказ #' . $order->id . ' - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Заказ #' . $order->id;
?>

<div class="user-view">



    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [
            //'id',
            [
                'attribute' => 'created_at',
                'value' => function() use ($order){
                    $date_order = Yii::$app->formatter->asDatetime($order->created_at, 'php:d.m.Y H:i:s');
                    return $date_order;

                }

            ],
            [
                'attribute' => 'current_status',
                'value' => OrderHelper::statusLabel($order->current_status),
                'format' => 'raw',
            ],
            [
                'attribute' => 'delivery_datetime',
                'value' => function($order) {
                    return date('d-m-Y H:i', $order->delivery_datetime);
                },

            ],
            'recipientData.name',
            'recipientData.phone',
            'recipientData.address',
            [
                'attribute' => 'cost',
                'value' => $order->getTotalCost() . ' руб.',
            ],
            'note:ntext',
        ],
    ]) ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Название</th>
                <th class="text-left">Количество</th>
                <th class="text-right">Цена</th>
                <th class="text-right">Итого</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->items as $item): ?>
                <tr>
                    <td class="text-left">
                        <?= Html::encode($item->product_name) ?>
                    </td>
                    <!--<td class="text-left">
                        <?/*= Html::encode($item->modification_code) */?>
                        <?/*= Html::encode($item->modification_name) */?>
                    </td>-->
                    <td class="text-left">
                        <?= $item->quantity ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->price) ?></td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($order->canBePaid()): ?>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Оплатите товар!</h3>
            </div>
            <div class="panel-body">
                <p>Внимание! Закзаз будет принят и обработан только после полной оплаты товара.</p>
                <p>Оплатите товар самым удобным способом на карту Сбербанка <img src="<?= Yii::getAlias('@web/image/sberbank.svg') ?>" alt="Сбербанк" width="20px" height="20px"><span class="pay_card"> 5469 7400 1364 1992</span><br>
                    укажите в сообщении: <b>Заказ #<?= $order->id ?></b><br>получатель Ольга Анатольевна С - флорист.</p>
            </div>
        </div>
    <?php endif; ?>

</div>