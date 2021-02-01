<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

}
