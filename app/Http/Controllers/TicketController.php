<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Http\Response;
use App\Services\TicketService;
use App\Traits\Logger;
use Exception;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    use Logger;

    /**
     * @var TicketService $service
     */
    private TicketService $service;

    /**
     * @param TicketService $service
     */
    function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     *
     * @return JsonResponse
     */
    public function create(TicketRequest $request): JsonResponse
    {
        $response = new Response();
        $attributes = $request->all();
        $this->debug('Creating the ticket', $attributes);

        try {

            $ticket = $this->service->create($attributes);

            return $response->success(new TicketResource($ticket));

        } catch (Exception $e) {

            $this->error('Could not create the ticket', ['reason' => $e->getMessage()]);
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
        $this->debug('Getting the list of tickets');

        try {

            $tickets = $this->service->list();

            return $response->success(new TicketCollection($tickets));

        } catch (Exception $e) {

            $this->debug('Could not get the list of tickets', [
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

        $this->debug('Deleting the ticket', ['id' => $id]);

        try {

            $this->service->delete($id);

            return $response->success();

        } catch (DataNotFound $e) {

            $this->debug('Could not delete the ticket', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not delete the ticket', [
                'id' => $id,
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
        $this->debug('Getting the specified ticket', ['id' => $id]);

        try {

            $ticket = $this->service->get($id);

            return $response->success(new TicketResource($ticket));

        } catch (DataNotFound $e) {

            $this->debug('Could not get the specified of ticket', [
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->debug('Could not get the specified of ticket', [
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

}
