<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'provider' => $this->provider,
            'item_id' => $this->item_id,
            'click_out_link' => $this->click_out_link,
            'main_photo_url' => $this->main_photo_url,
            'price' => $this->price,
            'price_currency' => $this->price_currency,
            'shipping_price' => $this->shipping_price,
            'title' => $this->title,
            'description' => $this->description,
            'valid_until' => $this->valid_until,
            'brand' => $this->brand,
        ];
    }
}
