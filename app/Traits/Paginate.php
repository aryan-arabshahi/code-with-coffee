<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

trait Paginate
{

    /**
     * @param string $resourceClass = null
     * @param array|JsonResource $data = []
     * 
     * @return array
     */
    private function paginate(string $resourceClass = null, array|JsonResource $data = []): array
    {
        // Preparing the data based on the resourceClass
        if ($resourceClass) {
            $data = $this->collection->map(function($resource) use ($resourceClass) {
                return new $resourceClass($resource);
            });
        }

        return [
            'total' => $this->total(),
            'perPage' => $this->perPage(),
            'currentPage' => $this->currentPage(),
            'lastPage' => $this->lastPage(),
            'prev'  => $this->previousPageUrl(),
            'next'  => $this->nextPageUrl(),
            'path'  => $this->path(),
            'data' => $data,
        ];
    }

}
