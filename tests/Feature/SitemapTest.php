<?php

namespace Tests\Feature;

use App\Services\SitemapService;
use Tests\BaseTest;

class SitemapTest extends BaseTest
{

    /**
     * Generate the Sitemap
     *
     * @return void
     */
    public function test_generate_sitemap()
    {
        $service = app(SitemapService::class);
        $service->generate();
        $this->assertTrue(true);
    }

}
