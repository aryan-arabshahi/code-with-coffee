<?php

namespace Tests;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Http\UploadedFile;

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

    /**
     * Create a fake image
     */
    protected function fakeImage(): UploadedFile
    {
        return UploadedFile::fake()->image('fake-image.png', 500, 500);
    }

}
