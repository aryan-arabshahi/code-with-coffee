<?php

namespace App\Repositories\Eloquent;

use App\Enums\ArticleStatus;
use App\Exceptions\DataNotFound;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\Logger;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    use Logger;

    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the latest articles
     * 
     * @param int $count Count of the latest items
     * 
     * @return Collection
     */
    public function latest(int $count): Collection
    {
        $this->debug('Getting the latest active articles', ['count' => $count]);
        return $this->model
            ->whereStatus(ArticleStatus::ENABLED)
            ->take($count)
            ->orderBy('id', 'desc')
            ->get();
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
        $article = $this->model->whereSlug($slug)->first();

        if (!$article) {
            throw new DataNotFound;
        }

        return $article;
    }

    /**
     * Get the list of the enabled articles
     * 
     * @param int $paginatePerPage = 0 Use the default pagination as default
     * 
     * @return LengthAwarePaginator
     */
    public function listActiveArticles(int $paginatePerPage = 0): LengthAwarePaginator
    {
        $this->debug('Getting the list of the enabled articles');
        return $this->model
            ->whereStatus(ArticleStatus::ENABLED)
            ->paginate(
                ($paginatePerPage) ? $paginatePerPage : $this->paginatePerPage
            );
    }

}
