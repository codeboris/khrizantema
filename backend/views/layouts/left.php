<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::getAlias('@web/img/user_empty.svg') ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => 'Пользователи', 'icon' => 'user-o', 'url' => ['/user/index'], 'active' => $this->context->id === 'user'],
                    ['label' => 'Заказы', 'icon' => 'file-o', 'url' => ['/shop/order/index'], 'active' => $this->context->id == 'shop/order'],

                    ['label' => 'Магазин', 'icon' => 'folder', 'items' => [
                        ['label' => 'Товары', 'icon' => 'file-o', 'url' => ['/shop/product/index'], 'active' => $this->context->id === 'shop/product'],
                        ['label' => 'Бренды', 'icon' => 'file-o', 'url' => ['/shop/brand/index'], 'active' => $this->context->id === 'shop/brand'],
                        ['label' => 'Теги', 'icon' => 'file-o', 'url' => ['/shop/tag/index'], 'active' => $this->context->id === 'shop/tag'],
                        ['label' => 'Категории', 'icon' => 'file-o', 'url' => ['/shop/category/index'], 'active' => $this->context->id === 'shop/category'],
                        ['label' => 'Характеристики', 'icon' => 'file-o', 'url' => ['/shop/characteristic/index'], 'active' => $this->context->id === 'shop/characteristic'],
                        //['label' => 'Методы доставки', 'icon' => 'file-o', 'url' => ['/shop/delivery/index'], 'active' => $this->context->id == 'shop/delivery'],
                    ]],
                    ['label' => 'Блог', 'icon' => 'folder', 'items' => [
                        ['label' => 'Посты', 'icon' => 'file-o', 'url' => ['/blog/post/index'], 'active' => $this->context->id == 'blog/post'],
                        ['label' => 'Комментарии', 'icon' => 'file-o', 'url' => ['/blog/comment/index'], 'active' => $this->context->id == 'blog/comment'],
                        ['label' => 'Теги', 'icon' => 'file-o', 'url' => ['/blog/tag/index'], 'active' => $this->context->id == 'blog/tag'],
                        ['label' => 'Категории', 'icon' => 'file-o', 'url' => ['/blog/category/index'], 'active' => $this->context->id == 'blog/category'],
                    ]],
                    ['label' => 'Контент', 'icon' => 'folder', 'items' => [
                        ['label' => 'Страницы', 'icon' => 'file-o', 'url' => ['/page/index'], 'active' => $this->context->id == 'page'],
                        ['label' => 'Файлы', 'icon' => 'file-o', 'url' => ['/file/index'], 'active' => $this->context->id == 'file'],
                    ]],
                    /*['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
