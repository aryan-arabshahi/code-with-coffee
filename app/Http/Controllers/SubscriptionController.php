<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Http\Requests\SubscribeRequest;
use App\Http\Resources\SubscriberCollection;
use App\Http\Response;
use App\Services\SubscriptionService;
use App\Traits\Logger;
use Exception;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    use Logger;

    /**
     * @var SubscriptionService $service
     */
    private SubscriptionService $service;

    /**
     * @param SubscriptionService $service
     */
    function __construct(SubscriptionService $service)
    {
        $this->service = $service;
    }

    /**
     * Subscribe an email address
     * 
     * @param SubscribeRequest $request
     * 
     * @return JsonResponse
     */
    public function postSubscribe(SubscribeRequest $request): JsonResponse
    {
        $response = new Response();
        $attributes = $request->only('email');
        $this->debug('Creating the subscriber', $attributes);

        try {

            $subscriber = $this->service->create($attributes);

            return $response->success();

        } catch (Exception $e) {

            $this->error(
                'Could not add the email to the subscribers list',
                ['reason' => $e->getMessage()]
            );
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getSubscribers(): JsonResponse
    {
        $response = new Response();
        $this->debug('Getting the list of subscribers');

        try {

            $subscribers = $this->service->subscribers();

            return $response->success(new SubscriberCollection($subscribers));

        } catch (Exception $e) {

            $this->debug('Could not get the list of subscribers', [
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

}
