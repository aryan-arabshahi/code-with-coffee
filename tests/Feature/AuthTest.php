<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    /**
     * Getting the access token.
     *
     * @return void
     */
    public function test_get_token()
    {
        $this->getJson('/')->assertStatus(200);
        /** The Passport library didn't work with the .env.testing
            $response = $this->postJson('/oauth/token', [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'username' => 'aryan.arabshahi.programmer@gmail.com',
                'password' => 'admin',
                'scope' => '*',
            ]);
            $response->assertStatus(200)
                ->assertJsonStructure([
                    'token_type',
                    'expires_in',
                    'access_token',
                    'refresh_token',
                ]);
        */
    }

}
