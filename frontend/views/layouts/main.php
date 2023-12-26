<?php
/* @var $this \yii\web\View */
/* @var $content string */
use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\widgets\Shop\CartCountItemsWidget;
use frontend\widgets\Shop\CartWidget;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE]><![endif]-->
    <!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
    <!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!-->
    <html dir="ltr" lang="<?= Yii::$app->language ?>">
    <!--<![endif]-->
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="yandex-verification" content="b240c4e6b95e63a9" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>


        <link rel="apple-touch-icon" sizes="180x180" href="<?= Yii::getAlias('@web/apple-touch-icon.png') ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= Yii::getAlias('@web/favicon-32x32.png') ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::getAlias('@web/favicon-16x16.png') ?>">
        <link rel="manifest" href="<?= Yii::getAlias('@web/site.webmanifest') ?>">
        <link rel="mask-icon" href="<?= Yii::getAlias('@web/safari-pinned-tab.svg') ?>" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">



        <?php $this->head() ?>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(57488206, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/57488206" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </head>

    <?php $this->beginBody() ?>
<div class="wrap">
    <div class="container">
        <div class="row header_top">
            <div class="col-sm-8 col-xs-12">
                <div class="logo">
                    <a href="/"><span>Хризантема<img src="<?= Yii::getAlias('@web/image/flow_rgb.png') ?>" alt="">&nbsp;ру</span></a><br>
                    <h1 class="logo_title">Доставка цветов и оформление букетов.</h1>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="phone_social">
                    <div class="phone_viber">
                        <a title="Viber" href="viber://add?number=79240217070">
                            <img src="<?= Yii::getAlias('@web/image/viber.png') ?>">
                        </a>
                    </div>
                    <div class="phone_whatsapp">
                        <a title="WhatsApp" href="whatsapp://send?phone=+79240217070">
                            <img src="<?= Yii::getAlias('@web/image/whatsapp.png') ?>">
                        </a>
                    </div>
                    <div class="phone_telegram">
                        <a title="Telegram" href="tg://resolve?domain=khrizantema_ru">
                            <img src="<?= Yii::getAlias('@web/image/telegram.png') ?>">
                        </a>
                    </div>
                </div>
                <div class="online_title">
                    <span>Online чат</span>
                </div>
                <div class="phone_block"><span class="phone_num"><a title="Позвонить" href="tel:+79240217070">+7(924) 021-70-70</a></span></div>
            </div>
        </div>
        <div class="row header_nav">
            <div class="col-md-6 col-xs-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="pull-right">

                    <ul class="list-inline">
                        <li>
                            <a href="<?= Url::to(['/catalog']) ?>" title="Каталог">
                                <i class="fa fa-shopping-bag"></i> <span class="hidden-xs hidden-sm"><span>Каталог</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/contact']) ?>" title="Контакты">
                                <i class="fa fa-comments-o"></i> <span class="hidden-xs hidden-sm">Контакты</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/cabinet/wishlist/index']) ?>" title="Избранное">
                                <i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm"><span>Избранное</span>
                            </a>
                        </li>
                        <li>
                            <?/*= CartWidget::widget() */?>
                            <a href="<?= Url::to(['/shop/cart/index']) ?>" title="Корзина">
                                <i class="fa fa-shopping-cart"><?= CartCountItemsWidget::widget() ?></i> <span class="hidden-xs hidden-sm">Корзина</span>
                            </a>
                        </li>
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <li>
                                <a href="<?= Url::to(['/cabinet']) ?>" title="Личный кабинет">
                                    <i class="fa fa-user"></i> <span class="hidden-xs hidden-sm"><span><?= Yii::$app->user->identity->username ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <!--<li><a href="/index.php?route=information/contact"><i class="fa fa-phone"></i></a>
                            <span class="hidden-xs hidden-sm hidden-md">123456789</span></li>
                        <li class="dropdown"><a href="/index.php?route=account/account" title="My Account"
                                                class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">My Account</span> <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <?php /*if (Yii::$app->user->isGuest): */?>
                                    <li><a href="<?/*= Html::encode(Url::to(['/auth/auth/login'])) */?>">Login</a></li>
                                    <li><a href="<?/*= Html::encode(Url::to(['/auth/signup/request'])) */?>">Signup</a></li>
                                <?php /*else: */?>
                                    <li><a href="<?/*= Html::encode(Url::to(['/cabinet/default/index'])) */?>">Cabinet</a></li>
                                    <li><a href="<?/*= Html::encode(Url::to(['/auth/auth/logout'])) */?>" data-method="post">Logout</a></li>
                                <?php /*endif; */?>
                            </ul>
                        </li>
                        <li><a href="<?/*= Url::to(['/cabinet/wishlist/index']) */?>" id="wishlist-total"
                               title="Wish List"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md">Wish List</span></a>
                        </li>
                        <li><a href="<?/*= Url::to(['/shop/cart/index']) */?>" title="Shopping Cart"><i
                                    class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span></a>
                        </li>
                        <li><a href="/index.php?route=checkout/checkout" title="Checkout"><i
                                    class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Checkout</span></a>
                        </li>-->
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p>Хризантема.ру - доставка цветов и оформление букетов.</p>
            </div>
            <div class="col-md-4">
                <p>Вы можете заказать услуги флориста:</p>
                <p>Оформление букетов по вашему желанию</p>
                <p>Сборка композиций из свежих цветов, фруктов, подарков.</p>
            </div>
            <div class="col-md-4">
                <p>Khrizantema.ru &copy; <?= date('Y') ?> Все права защищены. Любое копирование материалов, без согласия автора, будет преследоваться законом.</p>
            </div>
        </div>
    </div>
</footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>