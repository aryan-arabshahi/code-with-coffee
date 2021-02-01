<?php

namespace App\Services;

use App\Traits\Logger;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    use Logger;

    /**
     * @var CategoryRepositoryInterface $repository
     */
    private CategoryRepositoryInterface $repository;

    function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a category
     * 
     * @param array $attributes
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function create(array $attributes, bool $toArray = false): mixed
    {
        $this->debug('Creating the category', $attributes);
        $category = $this->repository->create($attributes);
        return (!$toArray) ? $category : $category->toArray();
    }

    /**
     * Display a listing of the resource.
     * 
     * @param bool $toArray = false
     * 
     * @return array|Collection
     */
    public function list(bool $toArray = false): mixed
    {
        $this->debug('Getting the list of categories');
        $categories = $this->repository->list();
        return (!$toArray) ? $categories : $categories->toArray();
    }

    /**
     * Remove the specified category
     * 
     * @param string $id
     * 
     * @return void
     * 
     * @throws DataNotFound
     */
    public function delete(string $id): void
    {
        $this->debug('Deleting the category', ['id' => $id]);
        $this->repository->delete($id);
    }

    /**
     * Remove the specified category
     * 
     * @param string $id
     * @param array $attributes
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function update(string $id, array $attributes, bool $toArray = false): mixed
    {
        $this->debug('Updating the category', ['id' => $id, 'attributes' => $attributes]);
        $category = $this->repository->update($id, $attributes);
        return (!$toArray) ? $category : $category->toArray();
    }

    /**
     * Get the specified category.
     * 
     * @param string $id
     * @param bool $toArray = false
     * 
     * @return mixed
     * 
     * @throws DataNotFound
     */
    public function get(string $id, bool $toArray = false): mixed
    {
        $this->debug('Getting the category', ['id' => $id]);
        $category = $this->repository->get($id);
        return (!$toArray) ? $category : $category->toArray();
    }

}
