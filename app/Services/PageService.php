<?php

namespace App\Services;

use App\Interfaces\PageRepositoryInterface;
use App\Traits\Logger;

class PageService
{
    use Logger;

    /**
     * @var PageRepositoryInterface $repository
     */
    private PageRepositoryInterface $repository;

    function __construct(PageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a page
     * 
     * @param array $attributes
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function create(array $attributes, bool $toArray = false): mixed
    {
        $this->debug('Creating the page', $attributes);
        $page = $this->repository->create($attributes);
        return (!$toArray) ? $page : $page->toArray();
    }

    /**
     * Remove the specified page
     * 
     * @param string $id
     * @param array $attributes
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function update(string $id, array $attributes, bool $toArray = false): mixed
    {
        $this->debug('Updating the page', ['id' => $id, 'attributes' => $attributes]);
        $page = $this->repository->update($id, $attributes);
        return (!$toArray) ? $page : $page->toArray();
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
        $this->debug('Getting the list of pages');
        $pages = $this->repository->list();
        return (!$toArray) ? $pages : $pages->toArray();
    }

    /**
     * Get the specified page.
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
        $this->debug('Getting the page', ['id' => $id]);
        $page = $this->repository->get($id);
        return (!$toArray) ? $page : $page->toArray();
    }

    /**
     * Remove the specified page
     * 
     * @param string $id
     * 
     * @return void
     * 
     * @throws DataNotFound
     */
    public function delete(string $id): void
    {
        $this->debug('Deleting the page', ['id' => $id]);
        $this->repository->delete($id);
    }

}
