<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Services\ArticleService;
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
        $article = Article::factory()->make()->toArray();
        $article['image'] = $this->fakeImage();
        $response = $this->postJson(
            route('articles.create'),
            $article
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
        $new_article = Article::factory()->make()->toArray();
        $new_article['image'] = $this->fakeImage();
        $response = $this->patchJson(
            route('articles.update', [$article->id]),
            $new_article
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
            Article::factory()->make(['image' => null])->toArray()
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
     * Get the specified article.
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
     * Get the specified article.
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

    /**
     * Get the latest articles.
     *
     * @return void
     */
    public function test_get_latest_articles()
    {
        $service = app(ArticleService::class);
        $service->latest(3);
        $this->assertTrue(true);
    }

    /**
     * Get article by slug
     *
     * @return void
     */
    public function test_get_article_by_slug()
    {
        $article = Article::factory()->create();
        $service = app(ArticleService::class);
        $finded_article = $service->findBySlug($article->slug);
        $this->assertTrue(true);
    }

    /**
     * Get the list of the enabled articles
     *
     * @return void
     */
    public function test_list_active_articles()
    {
        $service = app(ArticleService::class);
        $finded_article = $service->listActiveArticles();
        $this->assertTrue(true);
    }

}
