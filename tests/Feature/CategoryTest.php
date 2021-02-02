<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\BaseTest;

class CategoryTest extends BaseTest
{

    /**
     * Create a category
     *
     * @return void
     */
    public function test_create_category()
    {
        $response = $this->postJson(
            route('categories.create'),
            Category::factory()->make()->toArray()
        );
        $response->assertStatus(200);
    }

    /**
     * Update the specified category.
     *
     * @return void
     */
    public function test_update_category()
    {
        $category = Category::factory()->create();
        $response = $this->patchJson(
            route('categories.update', [$category->id]),
            Category::factory()->make()->toArray()
        );
        $response->assertStatus(200);
    }

    /**
     * Update the specified category.
     *
     * @return void
     */
    public function test_update_category_404()
    {
        $response = $this->patchJson(
            route('categories.update', [-1]),
            Category::factory()->make()->toArray()
        );
        $response->assertStatus(404);
    }

    /**
     * Get the list of the resource.
     *
     * @return void
     */
    public function test_list_category()
    {
        $response = $this->getJson(route('categories.list'));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified category.
     *
     * @return void
     */
    public function test_get_category()
    {
        $category = Category::factory()->create();
        $response = $this->getJson(route('categories.get', [$category->id]));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified category.
     *
     * @return void
     */
    public function test_get_category_404()
    {
        $response = $this->getJson(route('categories.get', [-1]));
        $response->assertStatus(404);
    }

    /**
     * Delete the specified category.
     *
     * @return void
     */
    public function test_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->deleteJson(route('categories.delete', [$category->id]));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified category.
     *
     * @return void
     */
    public function test_delete_category_404()
    {
        $response = $this->deleteJson(route('categories.delete', [-1]));
        $response->assertStatus(404);
    }

}
