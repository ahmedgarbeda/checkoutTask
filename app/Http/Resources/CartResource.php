<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'item_id' =>$this->item_id,
            'name' => $this->item->name,
            'price' => $this->item->price,
            'quantity' => $this->quantity,
            'total' => $this->quantity * $this->item->price

        ];
    }
}
