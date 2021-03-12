<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DataNotFound;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\Logger;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    use Logger;

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get a category by name
     * 
     * @param string $name
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function findByName(string $name): Model
    {
        $this->debug('Getting the specified category', ['name' => $name]);
        $category = $this->model->whereName($name)->first();

        if (!$category) {
            throw new DataNotFound;
        }

        return $category;
    }

}
