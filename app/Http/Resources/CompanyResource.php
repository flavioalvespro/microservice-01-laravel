<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'identity' => $this->uuid,
            'name' => $this->name,
            'url' => $this->url,
            'email' => $this->email,
            'phone' => $this->phone,
            'category' => new CategoryResource($this->category),
            'image' => url("storage/{$this->image}")
        ];
    }
}
