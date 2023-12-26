<?php

use shop\entities\User\User;
use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */
$this->title = 'Заказ #' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $order->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $order,
                'attributes' => [
                    'id',
                    'created_at:datetime',
                    [
                        'attribute' => 'current_status',
                        'value' => OrderHelper::statusLabel($order->current_status),
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'Покупатель',
                        'value' => function($order) {
                                if ($user = User::findOne($order->user_id)){
                                    return $user->username;
                                }else{
                                    return 'Гость';
                                }

                        },
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
                    //'user_id',
                    //'delivery_method_name',
                    //'deliveryData.index',
                    //'deliveryData.address',
                    'cost',
                    'note:ntext',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0">
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
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0">
                    <thead>
                    <tr>
                        <th class="text-left">Дата и время изменения заказа</th>
                        <th class="text-left">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order->statuses as $status): ?>
                        <tr>
                            <td class="text-left">
                                <?= Yii::$app->formatter->asDatetime($status->created_at) ?>
                            </td>
                            <td class="text-left">
                                <?= OrderHelper::statusLabel($status->value) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>