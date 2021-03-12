<?php

namespace App\Services;

use App\Interfaces\TicketRepositoryInterface;
use App\Traits\Logger;

class TicketService
{
    use Logger;

    /**
     * @var TicketRepositoryInterface $repository
     */
    private TicketRepositoryInterface $repository;

    function __construct(TicketRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a ticket
     * 
     * @param array $attributes
     * @param bool $toArray = false
     * 
     * @return mixed
     */
    public function create(array $attributes, bool $toArray = false): mixed
    {
        $this->debug('Creating the ticket', $attributes);
        $ticket = $this->repository->create($attributes);
        return (!$toArray) ? $ticket : $ticket->toArray();
    }

    /**
     * Display a listing of the resource.
     * 
     * @param bool $toArray = false
     * 
     * @return array|Collection
     */
    public function list(bool $toArray = false): mixed
    {
        $this->debug('Getting the list of tickets');
        $tickets = $this->repository->list();
        return (!$toArray) ? $tickets : $tickets->toArray();
    }

    /**
     * Remove the specified ticket
     * 
     * @param string $id
     * 
     * @return void
     * 
     * @throws DataNotFound
     */
    public function delete(string $id): void
    {
        $this->debug('Deleting the ticket', ['id' => $id]);
        $this->repository->delete($id);
    }

    /**
     * Get the specified ticket.
     * 
     * @param string $id
     * @param bool $toArray = false
     * 
     * @return mixed
     * 
     * @throws DataNotFound
     */
    public function get(string $id, bool $toArray = false): mixed
    {
        $this->debug('Getting the ticket', ['id' => $id]);
        $ticket = $this->repository->get($id);
        return (!$toArray) ? $ticket : $ticket->toArray();
    }

}
