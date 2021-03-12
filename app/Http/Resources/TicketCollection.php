<?php

namespace App\Http\Resources;

use App\Http\Resources\TicketResource;
use App\Traits\Paginate;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketCollection extends ResourceCollection
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
        return $this->paginate(TicketResource::class);
    }
}
