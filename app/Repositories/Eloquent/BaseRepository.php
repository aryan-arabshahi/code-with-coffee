<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DataNotFound;
use App\Interfaces\EloquentRepositoryInterface;
use App\Traits\Logger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    use Logger;

    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @var int $paginatePerPage
     */
    protected int $paginatePerPage;

    function __construct(Model $model)
    {
        $this->model = $model;
        $this->paginatePerPage = config('global.pagination_per_page');
    }

    /**
     * @param array $attributes
     * 
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $this->debug('Creating the resource', $attributes);
        return $this->model->create($attributes);
    }

    /**
     * @param string $id
     * @param array $with = [] The list of relations
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function get(string $id, array $with = []): Model
    {
        $this->debug('Getting the resource', ['id' => $id, 'with' => $with]);
        $result = $this->withRelations($with)->find($id);
        if (!$result) {
            $this->debug('Could not find the resource', ['id' => $id]);
            throw new DataNotFound();
        }
        return $result;
    }

    /**
     * @param int $paginate = 0 Zero means without pagination
     * @param array $with = [] The list of relations
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     */
    public function list(int $paginate = 0, array $with = []): mixed
    {
        if ($paginate === 0) {
            $paginate = $this->paginatePerPage;
        }
        $this->debug('Getting the list of resources', ['with' => $with]);

        $model = $this->withRelations($with)
                    ->orderBy(
                        $this->model->getKeyName(),
                        'desc'
                    );

        return ($paginate > 0) ? $model->paginate($paginate) : $model->get();
    }

    /**
     * @param string $id
     * 
     * @return void
     * 
     * @throws DataNotFound
     */
    public function delete(string $id): void
    {
        $this->debug('Deleting the resource', ['id' => $id]);
        $data = $this->get($id);
        $data->delete();
    }

    /**
     * @param string $id
     * @param array $attributes
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function update(string $id, array $attributes): Model
    {
        $this->debug('Updating the resource', ['id' => $id, 'attributes' => $attributes]);
        $data = $this->get($id);
        $data->update($attributes);
        return $data;
    }

    /**
     * Adding relations
     * 
     * @param array $relations
     * 
     * @return mixed
     */
    private function withRelations(array $relations): mixed
    {
        return ($relations) ? $this->model->with($relations) : $this->model;
    }

}
