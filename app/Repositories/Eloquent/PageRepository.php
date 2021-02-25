<?php

namespace App\Repositories\Eloquent;

use App\Models\Page;
use App\Traits\Logger;
use App\Exceptions\DataNotFound;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\PageRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    use Logger;

    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    /**
     * Get an page by slug
     * 
     * @param string $slug
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function findBySlug(string $slug): Model
    {
        $this->debug('Getting the specified page', ['slug' => $slug]);
        $page = $this->model->whereSlug($slug)->first();

        if (!$page) {
            throw new DataNotFound;
        }

        return $page;
    }

}
