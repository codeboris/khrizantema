<?php


/* @var $this yii\web\View  */
/* @var $product shop\entities\Shop\Product\Product  */
/* @var $model shop\forms\manage\Shop\Product\ModificationForm  */

$this->title = 'Создать Модификацию';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modification-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
