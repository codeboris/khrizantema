<?php
/* @var $this yii\web\View */
/* @var $user shop\entities\User\User */

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = 'Кабинет - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = 'Кабинет';



?>
<div class="cabinet-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <hr>
                <p><?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?></p>
                <div class="box">
                    <div class="box-body">
                        <?= DetailView::widget([
                            'model' => $user,
                            'attributes' => [
                                'username',
                                'email:email',
                                'phone'
                            ],
                        ]) ?>

                    </div>
                </div>



            </div>
        </div>
    </div>




</div>
