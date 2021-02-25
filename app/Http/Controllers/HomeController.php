<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Services\ArticleService;
use App\Services\PageService;
use Exception;
use Illuminate\View\View;

class HomeController extends Controller
{

    public function index(): View
    {
        $article_service = app(ArticleService::class);
        return view('pages.index', [
            'latestArticles' => $article_service->latest(3),
        ]);
    }

    public function getArticle(string $slug): View
    {
        try {

            $article_service = app(ArticleService::class);
            $article = $article_service->findBySlug($slug);

            return view('pages.article', [
                'article' => $article,
                'breadcrumb' => [
                    'Articles' => route('home.articles'),
                    $article->name => null,
                ],
            ]);

        } catch (DataNotFound $e) {

            abort(404);

        } catch (Exception $e) {

            abort(500);

        }
    }

    public function getArticles(): View
    {
        $article_service = app(ArticleService::class);

        $articles = $article_service->listActiveArticles(9);

        return view('pages.articles', [
            'articles' => $articles,
            'header' => 'News & Articles',
            'breadcrumb' => [
                'Articles' => null,
            ],
        ]);
    }

    public function getPage(string $slug): View
    {
        try {

            $page_service = app(PageService::class);
            $page = $page_service->findBySlug($slug);

            return view('pages.page', [
                'page' => $page,
                'breadcrumb' => [
                    $page->name => null,
                ],
            ]);

        } catch (DataNotFound $e) {

            abort(404);

        } catch (Exception $e) {

            abort(500);

        }
    }

}
