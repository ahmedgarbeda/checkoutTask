<?php

namespace App\Services;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;

class CheckoutService
{
    public function checkout($data)
    {
        $cart_items = $this->getCartItems();
        $data['total'] = $this->calculateCartTotal($cart_items);
        if ($this->checkCustomerCredit($data['total'])){
            $order = $this->createOrderRecord($data);
            $this->createOrderDetails($order,$this->prepareCartData($cart_items));
            $this->decreaseCustomerCredit($data['total']);
            $this->clearCartData();
            return 'payment successful';
        }
        return 'payment failed';
    }

    private function checkCustomerCredit($cart_total)
    {
        return Customer::first()->store_credit > $cart_total;
    }

    private function getCartItems()
    {
        $cartService = new CartService();
        return $cartService->getCartItems();
    }

    private function calculateCartTotal($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $cartItem)
        {
            $total += $cartItem->quantity * $cartItem->item->price;
        }
        return $total;
    }

    private function prepareCartData($cartItems)
    {
        $preparedData =[];
        foreach ($cartItems as $cartItem){
            $preparedData[]=[
                'item_id' => $cartItem->item_id,
                'price' => $cartItem->item->price,
                'quantity' => $cartItem->quantity
            ];
        }
        return $preparedData;
    }

    private function createOrderRecord($data)
    {
        return Order::create([
            'customer_id' => Customer::first()->id,  // should replaced with auth id
            'total' => $data['total'],
            'address' => $data['address'],
            'telephone' => $data['telephone']
        ]);
    }

    private function createOrderDetails($order,$cart_items)
    {
        return $order->orderItems()->createMany($cart_items);
    }

    private function decreaseCustomerCredit($total)
    {
        return Customer::first()->decrement('store_credit',$total);
    }

    private function clearCartData()
    {
        return Cart::where('customer_id',Customer::first()->id)->delete();
    }

}
