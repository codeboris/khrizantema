<?php
/* @var $this yii\web\View */
/* @var $category shop\entities\Blog\Category */
/* @var $model shop\forms\manage\Blog\CategoryForm */

$this->title = 'Редактировать категорию: ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>