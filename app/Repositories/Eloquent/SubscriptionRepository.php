<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\SubscriptionRepositoryInterface;
use App\Models\Subscriber;
use App\Repositories\Eloquent\BaseRepository;

class SubscriptionRepository extends BaseRepository implements SubscriptionRepositoryInterface
{

    public function __construct(Subscriber $model)
    {
        parent::__construct($model);
    }

}
