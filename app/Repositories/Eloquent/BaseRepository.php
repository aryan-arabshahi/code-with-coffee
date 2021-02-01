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

    function __construct(Model $model)
    {
        $this->model = $model;
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
     * 
     * @return Model
     * 
     * @throws DataNotFound
     */
    public function get(string $id): Model
    {
        $this->debug('Getting the resource', ['id' => $id]);
        $data = $this->model->find($id);
        if (!$data) {
            $this->debug('Could not find the resource', ['id' => $id]);
            throw new DataNotFound();
        }
        return $data;
    }

    /**
     * @param int $paginate = 0 Zero means without pagination
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     */
    public function list(int $paginate = 0): mixed
    {
        if ($paginate === 0) {
            $paginate = config('pagination.per_page');
        }
        $this->debug('Getting the list of resources');
        return ($paginate > 0) ? $this->model->paginate($paginate) : $this->model->get();
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

}
