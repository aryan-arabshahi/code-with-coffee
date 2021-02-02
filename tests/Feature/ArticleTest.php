<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\BaseTest;

class ArticleTest extends BaseTest
{

    /**
     * Create an article
     *
     * @return void
     */
    public function test_create_article()
    {
        $response = $this->postJson(
            route('articles.create'),
            Article::factory()->make()->toArray()
        );
        $response->assertStatus(200);
    }

    /**
     * Update the specified article.
     *
     * @return void
     */
    public function test_update_article()
    {
        $article = Article::factory()->create();
        $response = $this->patchJson(
            route('articles.update', [$article->id]),
            Article::factory()->make()->toArray()
        );
        $response->assertStatus(200);
    }

    /**
     * Update the specified article.
     *
     * @return void
     */
    public function test_update_article_404()
    {
        $response = $this->patchJson(
            route('articles.update', [-1]),
            Article::factory()->make()->toArray()
        );
        $response->assertStatus(404);
    }

    /**
     * Get the list of the resource.
     *
     * @return void
     */
    public function test_list_article()
    {
        $response = $this->getJson(route('articles.list'));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified article.
     *
     * @return void
     */
    public function test_get_article()
    {
        $article = Article::factory()->create();
        $response = $this->getJson(route('articles.get', [$article->id]));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified article.
     *
     * @return void
     */
    public function test_get_article_404()
    {
        $response = $this->getJson(route('articles.get', [-1]));
        $response->assertStatus(404);
    }

    /**
     * Delete the specified article.
     *
     * @return void
     */
    public function test_delete_article()
    {
        $article = Article::factory()->create();
        $response = $this->deleteJson(route('articles.delete', [$article->id]));
        $response->assertStatus(200);
    }

    /**
     * Delete the specified article.
     *
     * @return void
     */
    public function test_delete_article_404()
    {
        $response = $this->deleteJson(route('articles.delete', [-1]));
        $response->assertStatus(404);
    }

}
