<?php
use shop\entities\Shop\Order\Order;
use shop\helpers\OrderHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = 'Заказы';
?>

<div class="user-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => '№ Заказа',
                        'value' => function (Order $model) {
                            return Html::a(Html::encode("Заказ #".$model->id), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function(Order $model){
                            $date_order = Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
                            return $date_order;

                        }

                    ],
                    [
                        'attribute' => 'Статус',
                        'value' => function (Order $model) {
                            return OrderHelper::statusLabel($model->current_status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view}'
                    ],

                ],
            ]); ?>
        </div>
    </div>
</div>