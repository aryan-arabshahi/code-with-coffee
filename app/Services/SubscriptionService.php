<?php

namespace App\Services;

use App\Traits\Logger;
use App\Interfaces\SubscriptionRepositoryInterface;

class SubscriptionService
{
    use Logger;

    /**
     * @var SubscriptionRepositoryInterface $repository
     */
    private SubscriptionRepositoryInterface $repository;

    function __construct(SubscriptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a subscriber
     * 
     * @param array $attributes
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function create(array $attributes, bool $toArray = false): mixed
    {
        $this->debug('Creating the subscriber', $attributes);
        $subscriber = $this->repository->create($attributes);
        return (!$toArray) ? $subscriber : $subscriber->toArray();
    }

    /**
     * Display a listing of the resource.
     * 
     * @param bool $toArray = false
     * 
     * @return array|Collection
     */
    public function subscribers(bool $toArray = false): mixed
    {
        $this->debug('Getting the list of subscribers');
        $subscribers = $this->repository->list();
        return (!$toArray) ? $subscribers : $subscribers->toArray();
    }

}
