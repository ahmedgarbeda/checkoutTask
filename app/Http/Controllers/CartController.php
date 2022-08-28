<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(AddToCartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->addToCart($validated);
        return response()->json(['message' => 'successfully added to cart']);
    }

    public function getCartItems()
    {
        return response()->json([
            'data' => CartResource::collection($this->cartService->getCartItems())
        ]);
    }

    public function deleteCartItem($cartItemId)
    {
        try {
            $this->cartService->deleteCartItem($cartItemId);
            return response()->json(['message' => 'deleted successfully']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateCartData(UpdateCartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->updateCartData($validated);
        return response()->json([
            'message' => 'cart updated successfully',
            'data' => CartResource::collection($this->cartService->getCartItems())
            ]);
    }
}
