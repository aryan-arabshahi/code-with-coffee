<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Response;
use App\Services\CategoryService;
use App\Traits\Logger;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use Logger;

    /**
     * @var CategoryService $service
     */
    private CategoryService $service;

    /**
     * @param CategoryService $service
     */
    function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return JsonResponse
     */
    public function create(CreateCategoryRequest $request): JsonResponse
    {
        $response = new Response();
        $attributes = $request->all();
        $this->debug('Creating the category', $attributes);

        try {

            $category = $this->service->create($attributes);

            return $response->success(new CategoryResource($category));

        } catch (Exception $e) {

            $this->error('Could not create the category', ['reason' => $e->getMessage()]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function delete(string $id): JsonResponse
    {
        $response = new Response();

        $this->debug('Deleting the category', ['id' => $id]);

        try {

            $this->service->delete($id);

            return $response->success();

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the category', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the category', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Update the specified resource from storage.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, string $id): JsonResponse
    {
        $response = new Response();
        $attributes = $request->all();

        $this->debug('Updating the category', ['id' => $id, 'attributes' => $attributes]);

        try {

            $category = $this->service->update($id, $attributes);

            return $response->success(new CategoryResource($category));

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the category', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the category', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $response = new Response();
        $this->debug('Getting the list of categories');

        try {

            $categories = $this->service->list();

            return $response->success(new CategoryCollection($categories));

        } catch (Exception $e) {

            $this->debug('Could not get the list of categories', [
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Get the specified resource.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function get(string $id): JsonResponse
    {
        $response = new Response();
        $this->debug('Getting the specified category');

        try {

            $category = $this->service->get($id);

            return $response->success(new CategoryResource($category));

        } catch (DataNotFound $e) {

            $this->debug('Could not get the specified of category', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not get the specified of category', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

}
