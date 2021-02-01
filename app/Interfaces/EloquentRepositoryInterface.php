<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param string $id
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function get(string $id): Model;

    /**
     * @param int $paginate = 0 Zero means without pagination
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     */
    public function list(int $paginate = 0): mixed;

    /**
     * @param string $id
     * @param array $attributes
     * 
     * @return Collection
     */
    public function update(string $id, array $attributes): Model;

    /**
     * @param string $id
     * 
     * @return void
     */
    public function delete(string $id): void;

}
