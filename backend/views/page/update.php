<?php
/* @var $this yii\web\View */
/* @var $page shop\entities\Page */
/* @var $model shop\forms\manage\PageForm */

$this->title = 'Редактировать страницу: ' . $page->title;

$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $page->title, 'url' => ['view', 'id' => $page->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

?>

<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>