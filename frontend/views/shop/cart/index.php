<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */

use shop\helpers\PriceHelper;
//use shop\helpers\WeightHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корзина - ' . Yii::$app->name;

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = 'Корзина';

?>
<div class="cabinet-index">


    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="text-center" style="width: 100px">Фото</td>
                <td class="text-left">Название</td>
                <!--<td class="text-left">Артикул</td>-->
                <td class="text-left">Количество</td>
                <td class="text-right">Цена</td>
                <td class="text-right">Итого</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $modification = $item->getModification();
                $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                ?>
                <tr>
                    <td class="text-center">
                        <a href="<?= $url ?>">
                            <?php if ($product->mainPhoto): ?>
                                <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_list') ?>" alt="" class="img-thumbnail" />
                            <?php endif; ?>
                        </a>
                    </td>
                    <td class="text-left">
                        <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    </td>
                    <!--<td class="text-left">
                        <?php /*if ($modification): */?>
                            <?/*= Html::encode($modification->name) */?>
                        <?php /*endif; */?>
                    </td>-->
                    <td class="text-left">
                        <?= Html::beginForm(['quantity', 'id' => $item->getId()]); ?>
                        <div class="input-group btn-block" style="max-width: 200px;">
                            <input type="text" name="quantity" value="<?= $item->getQuantity() ?>" size="1" class="form-control" />
                            <span class="input-group-btn">
                                    <button type="submit" title="" class="btn btn-primary" data-original-title="Обновить"><i class="fa fa-refresh"></i></button>
                                    <a title="Удалить" class="btn btn-danger" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" data-method="post"><i class="fa fa-times-circle"></i></a>
                                </span>
                        </div>
                        <?= Html::endForm() ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->getPrice()) ?></td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br />
    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <?php $cost = $cart->getCost() ?>
            <table class="table table-bordered">
                <!--<tr>
                    <td class="text-right">Цена без скидок:</td>
                    <td class="text-right"><?/*= PriceHelper::format($cost->getOrigin()) */?></td>
                </tr>-->
                <?php foreach ($cost->getDiscounts() as $discount): ?>
                    <tr>
                        <td class="text-right"><?= Html::encode($discount->getName()) ?>:</td>
                        <td class="text-right"><?= PriceHelper::format($discount->getValue()) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="text-right">Итого:</td>
                    <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="buttons clearfix">
        <div class="pull-left"><a href="<?= Url::to('/shop/catalog/index') ?>" class="btn btn-default">Продолжить покупки</a></div>
        <?php if ($cart->getItems()): ?>
            <div class="pull-right btn-color"><a href="<?= Url::to('/shop/checkout/index') ?>" class="btn btn-primary">ЗАКАЗАТЬ</a></div>
        <?php endif; ?>
    </div>
</div>