<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                У вас нет достаточных прав, для совершения этого действия.<br>
                Вернитесь на главную страницу сайта <a href='<?= Yii::$app->frontendUrlManager->hostInfo; ?>'>Вернуться на сайт</a>
            </p>

            <!--<form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="Search"/>

                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>-->
        </div>
    </div>

</section>
