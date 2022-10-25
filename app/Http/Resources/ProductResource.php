<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'type'=> $this->type,
            'description' => $this->description,
            'image' => $this->image,
            'barcode' => $this->barcode,
            'buy_price' => $this->buy_price,
            'sell_price' => $this->sell_price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'image_url' => Storage::url($this->image)
        ];
    }
}
