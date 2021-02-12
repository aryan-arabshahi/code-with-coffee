<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;
use App\Repositories\Eloquent\BaseRepository;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{

    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

}
