<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Response;
use App\Services\ArticleService;
use App\Traits\Logger;
use Exception;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    use Logger;

    /**
     * @var ArticleService $service
     */
    private ArticleService $service;

    /**
     * @param ArticleService $service
     */
    function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     *
     * @return JsonResponse
     */
    public function create(ArticleRequest $request): JsonResponse
    {
        $response = new Response();
        $attributes = $request->except('cover');
        $this->debug('Creating the article', $attributes);

        try {

            $article = $this->service->create($attributes, $request->cover);

            return $response->success(new ArticleResource($article));

        } catch (Exception $e) {

            $this->error('Could not create the article', ['reason' => $e->getMessage()]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Update the specified resource from storage.
     *
     * @param string $id
     * @param ArticleRequest $request
     *
     * @return JsonResponse
     */
    public function update(ArticleRequest $request, string $id): JsonResponse
    {
        $response = new Response();
        $attributes = $request->except('cover');

        $this->debug('Updating the article', ['id' => $id, 'attributes' => $attributes]);

        try {

            $article = $this->service->update($id, $attributes, $request->cover);

            return $response->success(new ArticleResource($article));

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the article', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the article', [
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

        $this->debug('Deleting the article', ['id' => $id]);

        try {

            $this->service->delete($id);

            return $response->success();

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the article', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the article', [
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
        $this->debug('Getting the list of articles');

        try {

            $articles = $this->service->list();

            return $response->success(new ArticleCollection($articles));

        } catch (Exception $e) {

            $this->debug('Could not get the list of articles', [
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
        $this->debug('Getting the specified article');

        try {

            $article = $this->service->get($id);

            return $response->success(new ArticleResource($article));

        } catch (DataNotFound $e) {

            $this->debug('Could not get the specified of article', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not get the specified of article', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

}
