<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{

    /**
     * Get the latest articles
     * 
     * @param int $count Count of the latest items
     * 
     * @return Collection
     */
    public function latest(int $count): Collection;

    /**
     * Get an article by slug
     * 
     * @param string $slug
     * 
     * @return Model
     * 
     * @throws \App\Exceptions\DataNotFound
     */
    public function findBySlug(string $slug): Model;

    /**
     * Get the list of the enabled articles
     * 
     * @param int $paginatePerPage = 0 Use the default pagination as default
     * @param string|null $categoryId = null Get all the categories if it's null
     * @param string|null $name = null
     * 
     * @return LengthAwarePaginator
     */
    public function listActiveArticles(
        int $paginatePerPage = 0,
        string|null $categoryId = null,
        string|null $name = null
    ): LengthAwarePaginator;

}
