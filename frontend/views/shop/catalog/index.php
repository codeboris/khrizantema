<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */
use yii\helpers\Html;
$this->title = 'Каталог - '.Yii::$app->name;
$this->params['breadcrumbs'][] = 'Каталог';
?>

    <h1><?php /* Html::encode($this->title) */?></h1>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>