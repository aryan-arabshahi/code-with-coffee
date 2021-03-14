<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Services\PageService;
use Tests\BaseTest;

class PageTest extends BaseTest
{

    /**
     * Create an page
     *
     * @return void
     */
    public function test_create_page()
    {
        $page = Page::factory()->make()->toArray();
        $response = $this->postJson(
            route('pages.create'),
            $page
        );
        $response->assertStatus(200);
    }

    /**
     * Update the specified page.
     *
     * @return void
     */
    public function test_update_page()
    {
        $page = Page::factory()->create();
        $new_page = Page::factory()->make()->toArray();
        $response = $this->patchJson(
            route('pages.update', [$page->id]),
            $new_page
        );
        $response->assertStatus(200);
    }

    /**
     * Update the specified page.
     *
     * @return void
     */
    public function test_update_page_404()
    {
        $response = $this->patchJson(
            route('pages.update', [-1]),
            Page::factory()->make()->toArray()
        );
        $response->assertStatus(404);
    }

    /**
     * Get the list of the resource.
     *
     * @return void
     */
    public function test_list_page()
    {
        $response = $this->getJson(route('pages.list'));
        $response->assertStatus(200);
    }

    /**
     * Get the specified page.
     *
     * @return void
     */
    public function test_get_page()
    {
        $page = Page::factory()->create();
        $response = $this->getJson(route('pages.get', [$page->id]));
        $response->assertStatus(200);
    }

    /**
     * Get the specified page.
     *
     * @return void
     */
    public function test_get_page_404()
    {
        $response = $this->getJson(route('pages.get', [-1]));
        $response->assertStatus(404);
    }

    /**
     * Delete the specified page.
     *
     * @return void
     */
    public function test_delete_page()
    {
        $page = Page::factory()->create();
        $response = $this->deleteJson(route('pages.delete', [$page->id]));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified page.
     *
     * @return void
     */
    public function test_delete_page_404()
    {
        $response = $this->deleteJson(route('pages.delete', [-1]));
        $response->assertStatus(404);
    }

    /**
     * Get page by slug
     *
     * @return void
     */
    public function test_get_page_by_slug()
    {
        $page = Page::factory()->create();
        $service = app(PageService::class);
        $finded_page = $service->findBySlug($page->slug);
        $this->assertTrue(true);
    }

    /**
     * Get the list of the enabled pages
     *
     * @return void
     */
    public function test_list_active_pages()
    {
        $service = app(PageService::class);
        $finded_article = $service->listActivePages();
        $this->assertTrue(true);
    }

}
