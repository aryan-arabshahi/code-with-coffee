<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Tests\BaseTest;

class TicketTest extends BaseTest
{

    /**
     * Create a ticket
     *
     * @return void
     */
    public function test_create_ticket()
    {
        $response = $this->postJson(
            route('tickets.create'),
            Ticket::factory()->make()->toArray()
        );
        $response->assertStatus(200);
    }

    /**
     * Get the list of the resource.
     *
     * @return void
     */
    public function test_list_ticket()
    {
        $response = $this->getJson(route('tickets.list'));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified ticket.
     *
     * @return void
     */
    public function test_delete_ticket()
    {
        $ticket = Ticket::factory()->create();
        $response = $this->deleteJson(route('tickets.delete', [$ticket->id]));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified ticket.
     *
     * @return void
     */
    public function test_delete_ticket_404()
    {
        $response = $this->deleteJson(route('tickets.delete', [-1]));
        $response->assertStatus(404);
    }

    /**
     * Get the specified ticket.
     *
     * @return void
     */
    public function test_get_ticket()
    {
        $ticket = Ticket::factory()->create();
        $response = $this->getJson(route('tickets.get', [$ticket->id]));
        $response->assertStatus(200);
    }

    /**
     * Get the specified ticket.
     *
     * @return void
     */
    public function test_get_ticket_404()
    {
        $response = $this->getJson(route('tickets.get', [-1]));
        $response->assertStatus(404);
    }

}
