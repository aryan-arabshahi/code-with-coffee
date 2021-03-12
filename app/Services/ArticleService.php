<?php

namespace App\Services;

use App\Traits\Logger;
use App\Traits\HasImage;
use App\Enums\ArticleStatus;
use App\Exceptions\DataNotFound;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    use Logger, HasImage;

    /**
     * @var ArticleRepositoryInterface $repository
     */
    private ArticleRepositoryInterface $repository;

    /**
     * The module name used in the HasImage trait
     */
    protected $module = 'articles';

    function __construct(ArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a article
     * 
     * @param array $attributes
     * @param null|UploadedFile $image = null
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function create(
        array $attributes,
        null|UploadedFile $image = null,
        bool $toArray = false
    ): mixed
    {
        $this->debug('Creating the article', $attributes);

        // Store the uploaded image
        if ($image) {
            $attributes['image'] = $this->storeImage($image);
        }

        // Setting up the slug based on the name
        $attributes['slug'] = generate_slug($attributes['name']);

        $article = $this->repository->create($attributes);
        return (!$toArray) ? $article : $article->toArray();
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
        $this->debug('Getting the list of articles');
        $articles = $this->repository->list(with: ['category']);
        return (!$toArray) ? $articles : $articles->toArray();
    }

    /**
     * Remove the specified article
     * 
     * @param string $id
     * 
     * @return void
     * 
     * @throws DataNotFound
     */
    public function delete(string $id): void
    {
        $this->debug('Deleting the article', ['id' => $id]);
        $this->repository->delete($id);
    }

    /**
     * Remove the specified article
     * 
     * @param string $id
     * @param array $attributes
     * @param null|UploadedFile $image = null
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function update(
        string $id,
        array $attributes,
        null|UploadedFile $image = null,
        bool $toArray = false
    ): mixed
    {
        $this->debug('Updating the article', ['id' => $id, 'attributes' => $attributes]);

        // Replace the uploaded image
        if ($image) {
            $attributes['image'] = $this->storeImage($image);
        }

        // Setting up the slug based on the name
        $attributes['slug'] = generate_slug($attributes['name']);

        $article = $this->repository->update($id, $attributes);
        return (!$toArray) ? $article : $article->toArray();
    }

    /**
     * Get the specified article.
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
        $this->debug('Getting the article', ['id' => $id]);
        $article = $this->repository->get($id, with: ['category']);
        return (!$toArray) ? $article : $article->toArray();
    }

    /**
     * Get the latest articles
     * 
     * @param int $count Count of the latest items
     * @param bool $toArray = false
     * 
     * @return array|Collection
     */
    public function latest(int $count, bool $toArray = false): mixed
    {
        $this->debug('Getting the latest articles', ['count' => $count]);
        $articles = $this->repository->latest($count);
        return (!$toArray) ? $articles : $articles->toArray();
    }

    /**
     * Get an article by slug
     * 
     * @param string $slug
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function findBySlug(string $slug): Model
    {
        $this->debug('Getting the specified article', ['slug' => $slug]);
        $article = $this->repository->findBySlug($slug);

        if ($article->status != ArticleStatus::ENABLED) {
            throw new DataNotFound;
        }

        return $article;
    }

    /**
     * Get the list of the enabled articles
     * 
     * @param int $paginatePerPage = 0 Use the default pagination as default
     * @param int|null $categoryId = null Get all the categories if it's null
     * @param string|null $name = null
     * 
     * @return LengthAwarePaginator
     */
    public function listActiveArticles(
        int $paginatePerPage = 0,
        int|null $categoryId = null,
        string|null $name = null
    ): LengthAwarePaginator
    {
        $this->debug('Getting the list of the enabled articles', [
            'category_id' => $categoryId,
            'name' => $name,
        ]);
        return $this->repository->listActiveArticles(
            categoryId: $categoryId,
            name: $name,
            paginatePerPage: $paginatePerPage
        );
    }

}
