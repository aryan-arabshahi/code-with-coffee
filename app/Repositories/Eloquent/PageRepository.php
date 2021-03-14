<?php

namespace App\Repositories\Eloquent;

use App\Enums\PageStatus;
use App\Exceptions\DataNotFound;
use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\Logger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * Get the list of the enabled pages
     * 
     * @param int $paginatePerPage = 0 Use the default pagination as default
     * 
     * @return LengthAwarePaginator
     */
    public function listActivePages(int $paginatePerPage = 0): LengthAwarePaginator
    {
        $this->debug('Getting the list of the enabled pages');

        return $this->model
            ->whereStatus(PageStatus::ENABLED)
            ->paginate(
                ($paginatePerPage) ? $paginatePerPage : $this->paginatePerPage
            );
    }

}
