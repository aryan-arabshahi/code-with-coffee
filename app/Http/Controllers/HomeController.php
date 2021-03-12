<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\PageService;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(): View
    {
        $article_service = app(ArticleService::class);
        return view('pages.index', [
            'latestArticles' => $article_service->latest(6),
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

    public function getArticles(Request $request): View
    {
        /**
         * @var null|Illuminate\Database\Eloquent\Model
         */
        $category = $this->getCategoryByName($request->category);

        $article_service = app(ArticleService::class);

        $articles = $article_service->listActiveArticles(
            categoryId: $category->id ?? null,
            name: $request->search,
            paginatePerPage: 9
        );

        return view('pages.articles', [
            'articles' => $articles,
            'header' => 'News & Articles' . (($category) ? ": $category->name" : null),
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

    public function about(): View
    {
        return view('pages.about', [
            'header' => 'About Me',
            'breadcrumb' => [
                'About Me' => null,
            ],
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'header' => 'Contact Me',
            'breadcrumb' => [
                'Contact Me' => null,
            ],
        ]);
    }

    /**
     * Get the category ID by name
     * 
     * @param string|null $categoryName
     * 
     * @return null|Illuminate\Database\Eloquent\Model
     */
    private function getCategoryByName(string|null $categoryName): mixed
    {
        $category = null;

        if ($categoryName) {
            try {

                $category = app(CategoryService::class)
                    ->findByName($categoryName);

            } catch (DataNotFound $e) {
                $category = null;
            }
        }

        return $category;
    }

}
