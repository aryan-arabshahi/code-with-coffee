<?php

namespace App\Services;

use App\Services\ArticleService;
use App\Services\PageService;
use App\Traits\Logger;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapService
{
    use Logger;

    /**
     * @var \App\Services\ArticleService $articleService
     */
    private ArticleService $articleService;

    /**
     * @var \App\Services\PageService $pageService
     */
    private PageService $pageService;

    /**
     * @param \App\Services\ArticleService $articleService
     * @param \App\Services\PageService $pageService
     * 
     * @return void
     */
    function __construct(ArticleService $articleService, PageService $pageService)
    {
        $this->articleService = $articleService;
        $this->pageService = $pageService;
        $this->path = public_path('sitemap.xml');
        $this->isProduction = env('APP_ENV') == 'production';
        $this->sitemap = Sitemap::create();
    }

    /**
     * Generate the Sitemap
     */
    public function generate()
    {
        $this->debug('Generating the Sitemap', [
            'path' => $this->path,
            'is_production' => $this->isProduction,
        ]);

        $this->generateCustomPages();
        $this->generatePages();
        $this->generateArticles();

        if ($this->isProduction) {
            $this->sitemap->writeToFile($this->path);
        }
    }

    /**
     * Generate custom pages
     */
    private function generateCustomPages()
    {
        $this->debug('Generating the custom pages');

        $start_of_week = Carbon::now()->startOfWeek();

        $custom_pages = [
            route('home.index'),
            route('home.about'),
            route('home.contact'),
        ];

        foreach ($custom_pages as $custom_page) {
            $url = Url::create($custom_page)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setLastModificationDate($start_of_week);
            $this->sitemap->add($url);
        }

        $this->sitemap->add(
            Url::create(route('home.articles'))
        );
    }

    /**
     * Generate articles
     */
    private function generateArticles()
    {
        $this->debug('Generating articles');

        $articles = $this->articleService->listActiveArticles(paginatePerPage: 500);

        foreach ($articles as $article) {

            $url = Url::create(route('home.article', [$article->slug]))
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setLastModificationDate($article->updated_at);

            $this->sitemap->add($url);

        }
    }

    /**
     * Generate pages
     */
    private function generatePages()
    {
        $this->debug('Generating pages');

        $pages = $this->pageService->listActivePages(paginatePerPage: 500);

        foreach ($pages as $page) {

            $url = Url::create(route('home.page', [$page->slug]))
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setLastModificationDate($page->updated_at);

            $this->sitemap->add($url);

        }
    }

}
