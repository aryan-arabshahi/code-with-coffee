<?php

namespace App\Http\Resources;

use App\Traits\Paginate;
use App\Http\Resources\SubscriberResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubscriberCollection extends ResourceCollection
{
    use Paginate;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->paginate(SubscriberResource::class);
    }
}
