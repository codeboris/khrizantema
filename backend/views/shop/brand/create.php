<?php


/* @var $this yii\web\View  */
/* @var $model shop\forms\manage\Shop\BrandForm  */

$this->title = 'Создать Бренд';
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
