<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'name' => $this->name,
            'metadata' => ProductMetaResource::collection($this->whenLoaded('metadata')),
            'nameWithPrice' => $this->nameWithPrice()
            // $this->mergeWhen(true,[
            //     'name' => $this->name,
            //     'metadata' => $this->when(false, ProductMetaResource::collection($this->metadata)),
            // ]),
        ];
    }
}
