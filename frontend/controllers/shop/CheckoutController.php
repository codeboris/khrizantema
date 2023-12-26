<?php
namespace frontend\controllers\shop;

use shop\cart\Cart;
use shop\cart\CartItem;
use shop\entities\Shop\Order\Order;
use shop\forms\Shop\Order\OrderForm;
use shop\readModels\Shop\ProductReadRepository;
use shop\services\Shop\OrderService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CheckoutController extends Controller
{
    public $layout = 'blank';
    private $service;
    private $cart;
    private $products;

    public function __construct($id, $module, OrderService $service, Cart $cart, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->cart = $cart;
        $this->products = $products;
    }

    /*public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }*/

    /**
     * @param integer $id
     * @param bool $click
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex($id = null, $click = false)
    {
        if ($click){
            $this->addClick($id);
        }


        $form = new OrderForm(); //$this->cart->getWeight()
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $order = $this->service->checkout(Yii::$app->user->id, $form);
                if (Yii::$app->user->id){
                    return $this->redirect(['/cabinet/order/view', 'id' => $order->id]);
                }else{
                    return $this->redirect(['shop/checkout/view', 'id' => $order->id]);
                }

            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('index', [
            'cart' => $this->cart,
            'model' => $form,
        ]);
    }

    private function addClick($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('Товар не найден на складе.');
        }
        try {
            $this->cart->add(new CartItem($product, null, 1));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }

    public function actionView($id)
    {
        $order = Order::findOne($id);
        return $this->render('view', [
            'order' => $order,
        ]);
    }


}