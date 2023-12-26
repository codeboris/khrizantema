<?php


namespace common\bootstrap;


//use Elasticsearch\Client;
//use Elasticsearch\ClientBuilder;
use frontend\urls\CategoryUrlRule;
//use mihaildev\ckeditor\CKEditor;
//use mihaildev\elfinder\ElFinder;
use shop\cart\Cart;
use shop\cart\cost\calculator\DynamicCost;
use shop\cart\cost\calculator\SimpleCost;
use shop\cart\storage\CookieStorage;
////use shop\cart\storage\SessionStorage;
use shop\readModels\Shop\CategoryReadRepository;
use shop\services\ContactService;
use Yii;
use yii\base\BootstrapInterface;
use yii\caching\Cache;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;

//use yii\web\Session;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;

        /*$container->setSingleton(Client::class, function (){
            return ClientBuilder::create()->build();
        });*/

        $container->setSingleton(Cart::class, function (){
            return new Cart(
                new CookieStorage('cart', 3600),
                new DynamicCost(new SimpleCost())
            );
        });

        /*$container->setSingleton('cart2', function (){
            return new Cart(
                new DbStorage('cart', new Session()),
                new SimpleCost()
            );
        });*/

        $container->setSingleton(MailerInterface::class, function () use ($app){
            return $app->mailer;
        });

        /*$container->setSingleton('mailer2', function () use ($app){
            return $app->mailer2;
        });*/


        $container->setSingleton('cache', function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ContactService::class, [],[
            $app->params['adminEmail'],
        ]);

        /*$container->setSingleton(SignupService::class, [],[
            Instance::of('mailer2'),
        ]);*/

        $container->set(CategoryUrlRule::class, [], [
            Instance::of(CategoryReadRepository::class),
            Instance::of('cache'),
        ]);

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        /*$container->set(CKEditor::class,[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
        ]);*/

        /*$container->setSingleton(PasswordResetService::class, function () use ($app){
            return new PasswordResetService([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']);
        });*/
    }

}