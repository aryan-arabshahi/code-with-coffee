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
                'site_title' => get_site_title($article->name),
                'site_description' => $article->description,
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

        $page_title = __('app.pages.articles.title') . (($category) ? ": $category->name" : null);

        return view('pages.articles', [
            'site_title' => get_site_title($page_title),
            'site_description' => __('app.pages.articles.description'),
            'articles' => $articles,
            'header' => $page_title,
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
                'site_title' => get_site_title($page->name),
                'site_description' => $page->description,
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
        $page_title = __('app.pages.about.title');
        return view('pages.about', [
            'site_title' => get_site_title($page_title),
            'site_description' => __('app.pages.about.description'),
            'header' => $page_title,
            'breadcrumb' => [
                'About Me' => null,
            ],
        ]);
    }

    public function contact(): View
    {
        $page_title = __('app.pages.contact.title');
        return view('pages.contact', [
            'site_title' => get_site_title($page_title),
            'site_description' => __('app.pages.contact.description'),
            'header' => $page_title,
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
