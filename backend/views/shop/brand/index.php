<?php
/* @var $this yii\web\View  */
/* @var $searchModel backend\forms\Shop\BrandSearch  */
/* @var $dataProvider yii\data\ActiveDataProvider  */



use shop\entities\Shop\Brand;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Бренды';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="brand-index">
    <p>
        <?= Html::a('Создать Бренд',['create'], ['class' => 'btn btn-success'] ) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    //'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Brand $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'slug',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
