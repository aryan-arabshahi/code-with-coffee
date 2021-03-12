<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;
use App\Repositories\Eloquent\BaseRepository;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{

    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

}
