<?php
/* @var $this yii\web\View  */
/* @var $searchModel backend\forms\Shop\CategorySearch  */
/* @var $dataProvider yii\data\ActiveDataProvider  */



use shop\entities\Shop\Category;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">
    <p>
        <?= Html::a('Создать Категорию',['create'], ['class' => 'btn btn-success'] ) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function (Category $model) {
                            $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
                            return $indent . Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);

                        },
                        'format' => 'raw',
                    ],
                    [
                        'value' => function (Category $model) {
                            return
                                Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $model->id]) .
                                Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align: center'],
                    ],
                    'slug',
                    'title',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
