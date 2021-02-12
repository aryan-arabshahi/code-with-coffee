<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\View\View;

class HomeController extends Controller
{

    public function index(): View
    {
        $articleService = app(ArticleService::class);
        $articles = $articleService->list();
        return view('pages.index', [
            'articles' => $articles,
        ]);
    }

}
