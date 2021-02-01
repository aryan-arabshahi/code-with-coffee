<?php

namespace Tests\Feature;

use App\Services\CategoryService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseTest;

class CategoryTest extends BaseTest
{

    use WithFaker;

    /**
     * Create a category
     *
     * @return void
     */
    public function test_create_category()
    {
        $response = $this->postJson(route('categories.create'), [
            'name' => $this->faker->name,
        ]);
        $response->assertStatus(200);
    }

    /**
     * Update the specified category.
     *
     * @return void
     */
    public function test_update_category()
    {
        $category_id = $this->getFirstCategoryId();
        $response = $this->patchJson(route('categories.update', [$category_id]), [
            'name' => $this->faker->name,
        ]);
        $response->assertStatus(200);
    }

    /**
     * Update the specified category.
     *
     * @return void
     */
    public function test_update_category_404()
    {
        $response = $this->patchJson(route('categories.update', [-1]), [
            'name' => $this->faker->name,
        ]);
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
        $category_id = $this->getFirstCategoryId();
        $response = $this->getJson(route('categories.get', [$category_id]));
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
        $category_id = $this->getFirstCategoryId();
        $response = $this->deleteJson(route('categories.delete', [$category_id]));
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

    /**
     * Get the first category ID
     * 
     * @return string
     */
    private function getFirstCategoryId(): string
    {
        $service = app(CategoryService::class);
        return $service->list()->first()->id;
    }

}
