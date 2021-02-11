<?php

namespace App\Services;

use App\Interfaces\ArticleRepositoryInterface;
use App\Traits\HasImage;
use App\Traits\Logger;
use Illuminate\Http\UploadedFile;

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

}
