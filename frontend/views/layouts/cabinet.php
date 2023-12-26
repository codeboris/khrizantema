<?php

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row">
        <div id="content" class="col-sm-9">
            <?= $content?>
        </div>
        <aside id="column-right" class="col-sm-3">
            <div class="list-group">
                <?php if (Yii::$app->user->can('admin')): ?>
                    <a href="<?= Yii::$app->backendUrlManager->hostInfo ?>" target="_blank" class="list-group-item">Админка</a>
                <?php endif; ?>
                <!--<a href="/account/register" class="list-group-item">Register</a>-->
                <a href="/auth/reset/request" class="list-group-item">Поменять пароль</a>
                <!--<a href="/account/account" class="list-group-item">My Account</a>-->
                <a href="/cabinet/wishlist" class="list-group-item">Избранное</a>
                <a href="/cabinet/order" class="list-group-item">История заказов</a>
                <a href="/auth/auth/logout" class="list-group-item" data-method="post">Выход</a>
                <!--<a href="/account/newsletter" class="list-group-item">News Letter</a>-->
            </div>
        </aside>

    </div>
<?php $this->endContent() ?>