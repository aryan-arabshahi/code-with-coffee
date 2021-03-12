<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use Tests\BaseTest;

class SubscriptionTest extends BaseTest
{

    /**
     * Create a subscriber
     *
     * @return void
     */
    public function test_subscribe()
    {
        $subscriber = Subscriber::factory()->make()->toArray();
        $response = $this->postJson(
            route('newsletter.subscribe'),
            $subscriber
        );
        $response->assertStatus(200);
    }

    /**
     * Get the list of the resource.
     *
     * @return void
     */
    public function test_list_subscribers()
    {
        $response = $this->getJson(route('subscribers.list'));
        $response->assertStatus(200);
    }

}
