<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * Get the list of the enabled pages
     * 
     * @param int $paginatePerPage = 0 Use the default pagination as default
     * 
     * @return LengthAwarePaginator
     */
    public function listActivePages(int $paginatePerPage = 0): LengthAwarePaginator;

}
