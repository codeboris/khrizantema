<?php


/* @var $this yii\web\View  */
/* @var $brand shop\entities\Shop\Brand  */
/* @var $model shop\forms\manage\Shop\BrandForm  */

$this->title = 'Редактировать Бренд: ' . $brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<div class="brand-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
