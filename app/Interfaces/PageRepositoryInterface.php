<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface PageRepositoryInterface
{

    /**
     * Get an page by slug
     * 
     * @param string $slug
     * 
     * @return Model
     * 
     * @throws \App\Exceptions\DataNotFound
     */
    public function findBySlug(string $slug): Model;

}
