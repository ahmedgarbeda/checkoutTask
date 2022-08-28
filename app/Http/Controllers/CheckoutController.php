<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * @var CheckoutService
     */
    private $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(CheckoutRequest $request)
    {
        $validated = $request->validated();
        try {
            $message = $this->checkoutService->checkout($validated);
            return response()->json(['message' =>$message ]);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()],500);
        }

    }
}
