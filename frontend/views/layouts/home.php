<?php
/* @var $this \yii\web\View */
/* @var $content string */

//use frontend\widgets\Blog\LastPostsWidget;
use frontend\assets\OwlCarouselAsset;
use frontend\widgets\Blog\LastPostsWidget;
use frontend\widgets\Shop\FeaturedProductsWidget;

OwlCarouselAsset::register($this);
?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row">
        <div id="content" class="col-sm-12">
            <h3>Новые добавления в каталоге</h3>

            <?= FeaturedProductsWidget::widget([
                'limit' => 16,
            ]) ?>

            <!--<h3>Уголок флориста</h3>

            <?/*= LastPostsWidget::widget([
                'limit' => 4,
            ]) */?>

            <div id="carousel0" class="owl-carousel">
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png" alt="NFL"
                         class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="RedBull" class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png" alt="Sony"
                         class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="Coca Cola" class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="Burger King" class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png" alt="Canon"
                         class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="Harley Davidson" class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png" alt="Dell"
                         class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="Disney" class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="Starbucks" class="img-responsive"/>
                </div>
                <div class="item text-center">
                    <img src="http://static.khrizantema.local/cache/manufacturers/3.png"
                         alt="Nintendo" class="img-responsive"/>
                </div>
            </div>-->
        </div>
    </div>

<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
        
    dots: true
});') // nav: true, navText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],?>

<?php $this->registerJs('
$(\'#carousel0\').owlCarousel({
    items: 6,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
        
    dots: true
});') // nav: true, navText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],?>

<?php $this->endContent() ?>