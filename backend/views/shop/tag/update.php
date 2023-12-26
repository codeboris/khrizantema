<?php


/* @var $this yii\web\View  */
/* @var $tag shop\entities\Shop\Tag  */
/* @var $model shop\forms\manage\Shop\TagForm  */

$this->title = 'Редактировать Тег: ' . $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tag->name, 'url' => ['view', 'id' => $tag->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<div class="tag-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
