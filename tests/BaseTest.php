<?php

namespace Tests;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class BaseTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        /**
         * Bypassing the Auth:api for the guarded routes
         */
        Passport::actingAs(
            User::factory()->create()
        );
    }

}
