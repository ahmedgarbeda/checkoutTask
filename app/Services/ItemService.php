<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{

    public function get($limit = 12)
    {
        return Item::paginate($limit);
    }
}
