<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * @var ItemService
     */
    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function getAllItems(Request $request)
    {
        $items = $this->itemService->get($request->get('per_page'));
        return response()->json(ItemResource::collection($items));
    }
}
