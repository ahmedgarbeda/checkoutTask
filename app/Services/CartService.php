<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;

class CartService
{
    public function addToCart($data)
    {
        if ($cartItem = $this->checkIfExistInCart($data['item_id'])){
           return $this->updateCartItemQuantity($cartItem, ($cartItem->quantity + $data['quantity']));
        }
        $data['customer_id'] = Customer::first()->id; // should be auth id in real app
        return Cart::create($data);
    }

    private function checkIfExistInCart($item_id)
    {
        return Cart::where('item_id',$item_id)->first();
    }

    private function updateCartItemQuantity($item,$quantity)
    {
        return $item->update(['quantity' => $quantity]);
    }

    public function getCartItems()
    {
        return Cart::with(['item'])->where(['customer_id' => Customer::first()->id])->get(); // customer id should replaced with auth id
    }

    public function deleteCartItem($cartItemId)
    {
        return Cart::destroy($cartItemId);
    }

    public function getCartItemByItemId($id)
    {
        return Cart::where('item_id',$id)->first();
    }
    public function updateCartData($items)
    {
        foreach ($items as $item)
        {
            $this->updateCartItemQuantity($this->getCartItemByItemId($item['item_id']),$item['quantity']);
        }
        return true;
    }
}
