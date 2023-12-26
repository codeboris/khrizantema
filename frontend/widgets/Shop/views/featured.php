<?php
/** @var $products shop\entities\Shop\Product\Product[] */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Заказ и доставка цветов в Чите. тел: +7(924) 021-70-70 (Viber, WhatsApp, Telegramm) На сайте всегда можно найти готовый или заказать у флориста нужный вам букет или композицию.'
]);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'заказ, доставка, букеты, цветы, Чита, интернет-магазин, флористика']);
$this->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.khrizantema.ru']);
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
$this->registerMetaTag(['property' => 'og:title', 'content' => 'Заказ и доставка цветов в Чите.']);
$this->registerMetaTag(['property' => 'og:description', 'content' => 'На данном сайте всегда можно найти готовый или заказать у флориста нужный вам букет или композицию']);
$this->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->urlManager->createAbsoluteUrl(['favicon.png'])]);
?>

<div class="row">
    <?php if ($products): ?>

        <?php foreach ($products as $product): ?>

            <?php $url = Url::to(['/shop/catalog/product', 'id' =>$product->id]); ?>

            <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-thumb transition">

                    <?php if ($product->mainPhoto): ?>
                        <div class="image">
                            <a href="<?= Html::encode($url) ?>">
                                <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>" alt="" class="img-responsive" />
                            </a>
                        </div>
                    <?php endif; ?>

                    <div>
                        <div class="caption">
                            <h4><a class="caption_title" href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a></h4>
                            <p class="caption_description"><?= Html::encode(StringHelper::truncateWords(strip_tags($product->description), 20)) ?></p>
                            <p class="price">
                                <span class="price-new"><?= PriceHelper::format($product->price_new) ?></span>
                                <?php if ($product->price_old): ?>
                                    <span class="price-old"><?= PriceHelper::format($product->price_old) ?></span>
                                <?php endif; ?>
                            </p>
                        </div>

                        <div class="button-group">
                            <button type="button" href="<?= Url::to(['/shop/checkout', 'id' => $product->id, 'click' => true]) ?>" data-method="post" data-toggle="tooltip" title="Заказать"><i class="fa fa-hand-o-up"></i> Заказать в 1 клик</button>
                            <button type="button" href="<?= Url::to(['/shop/cart/add', 'id' => $product->id]) ?>" data-method="post" data-toggle="tooltip" title="Добавить в корзину"><i class="fa fa-shopping-cart"></i> <span class="">Добавить в корзину</span></button>
                            <button type="button" data-toggle="tooltip" title="Добавить в избранное" href="<?= Url::to(['/cabinet/wishlist/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-heart"></i> <span class="">Добавить в избранное</span></button>
                            <!--<button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('<?/*= $product->id */?>');"><i class="fa fa-exchange"></i></button>-->
                        </div>

                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
    <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <span>Нет товара в данной категории. Перейдите в </span>
        <a href="<?= Url::to(['/catalog']) ?>" title="Каталог">Каталог</a>
    </div>
    <?php endif; ?>
</div>