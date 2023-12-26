<?php
namespace shop\services\Shop;

use shop\cart\Cart;
use shop\cart\CartItem;
use shop\entities\Shop\Order\CustomerData;
//use shop\entities\Shop\Order\DeliveryData;
use shop\entities\Shop\Order\Order;
use shop\entities\Shop\Order\OrderItem;
use shop\entities\Shop\Order\RecipientData;
use shop\forms\Shop\Order\OrderForm;
//use shop\repositories\Shop\DeliveryMethodRepository;
use shop\repositories\NotFoundException;
use shop\repositories\Shop\OrderRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;
    //private $deliveryMethods;
    private $transaction;

    public function __construct(
        Cart $cart,
        OrderRepository $orders,
        ProductRepository $products,
        UserRepository $users,
        //DeliveryMethodRepository $deliveryMethods,
        TransactionManager $transaction
    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
        //$this->deliveryMethods = $deliveryMethods;
        $this->transaction = $transaction;
    }

    public function checkout($userId, OrderForm $form): Order
    {
        if ($user = $this->users->get($userId)){
            $userId = $user->id;
        }else{
            $userId = null;
        }
        $products = [];
        $items = array_map(function (CartItem $item) use (&$products) {
            $product = $item->getProduct();
            $product->checkout($item->getModificationId(), $item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationId(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());
        if (empty($items)){
            throw new NotFoundException('Вы не выбрали товар для заказа.');
        }
        $order = Order::create(
            $userId,
            new CustomerData(
                $form->customer->phone,
                $form->customer->name
            ),
            new RecipientData(
                $form->recipient->phone,
                $form->recipient->name,
                $form->recipient->address
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->delivery_datetime,
            $form->note
        );
        /*$order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->index,
                $form->delivery->address
            )
        );*/
        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            $this->cart->clear();
        });
        return $order;
    }
}