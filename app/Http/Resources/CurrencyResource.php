<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
class CurrencyResource extends JsonResource
{
    public static $wrap = 'rates';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            //'id' => $this->id,
            'code' => $this->code ?? null,
            'name' => $this->name  ?? null,
            'rate' => (double) $this->rate  ?? 0,
            'date' => $this->date,
        ];
    }
}
