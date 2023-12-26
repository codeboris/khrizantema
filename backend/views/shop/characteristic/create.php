<?php


/* @var $this yii\web\View  */
/* @var $model shop\forms\manage\Shop\CharacteristicForm  */

$this->title = 'Создать Характеристики';
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="сharacteristic-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
