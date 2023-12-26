<?php
/* @var $this yii\web\View  */
/* @var $searchModel backend\forms\Shop\TagSearch  */
/* @var $dataProvider yii\data\ActiveDataProvider  */



use shop\entities\Shop\Brand;
use shop\entities\Shop\Tag;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Теги';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tag-index">
    <p>
        <?= Html::a('Создать Тег',['create'], ['class' => 'btn btn-success'] ) ?>
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
                        'value' => function (Tag $model) {
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
