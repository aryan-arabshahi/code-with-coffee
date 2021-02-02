<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Repositories\Eloquent\BaseRepository;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{

    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

}
