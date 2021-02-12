<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Http\Requests\PageRequest;
use App\Http\Resources\PageCollection;
use App\Http\Resources\PageResource;
use App\Http\Response;
use App\Services\PageService;
use App\Traits\Logger;
use Exception;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    use Logger;

    /**
     * @var PageService $service
     */
    private PageService $service;

    /**
     * @param PageService $service
     */
    function __construct(PageService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     *
     * @return JsonResponse
     */
    public function create(PageRequest $request): JsonResponse
    {
        $response = new Response();
        $attributes = $request->all();

        $this->debug('Creating the page', $attributes);

        try {

            $page = $this->service->create($attributes);

            return $response->success(new PageResource($page));

        } catch (Exception $e) {

            $this->error('Could not create the page', ['reason' => $e->getMessage()]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Update the specified resource from storage.
     *
     * @param string $id
     * @param PageRequest $request
     *
     * @return JsonResponse
     */
    public function update(PageRequest $request, string $id): JsonResponse
    {
        $response = new Response();
        $attributes = $request->all();

        $this->debug('Updating the page', ['id' => $id, 'attributes' => $attributes]);

        try {

            $page = $this->service->update($id, $attributes);

            return $response->success(new PageResource($page));

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the page', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the page', [
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
        $this->debug('Getting the list of pages');

        try {

            $pages = $this->service->list();

            return $response->success(new PageCollection($pages));

        } catch (Exception $e) {

            $this->debug('Could not get the list of pages', [
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
        $this->debug('Getting the specified page');

        try {

            $page = $this->service->get($id);

            return $response->success(new PageResource($page));

        } catch (DataNotFound $e) {

            $this->debug('Could not get the specified of page', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not get the specified of page', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
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

        $this->debug('Deleting the page', ['id' => $id]);

        try {

            $this->service->delete($id);

            return $response->success();

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the page', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the page', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

}
