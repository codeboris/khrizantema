<?php
/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;


$url = Url::to(['product', 'id' =>$product->id]);

?>

<div class="product-layout product-list col-xs-12">
    <div class="product-thumb">
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