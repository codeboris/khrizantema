<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $tag shop\entities\Shop\Tag */

$this->title = $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $tag->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $tag->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить Тег?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $tag,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                ],
            ]) ?>
        </div>
    </div>

</div>