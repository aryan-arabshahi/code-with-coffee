<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{

    /**
     * Get a category by name
     * 
     * @param string $name
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function findByName(string $name): Model;

}
