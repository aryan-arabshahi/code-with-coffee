<?php

namespace App\Observers;

use App\Models\Article;
use App\Traits\Logger;

class ArticleObserver
{
    use Logger;

    /**
     * Handle the Article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        $image = $article->getOriginal('image');
        $this->debug('Removing the image', [
            'module' => $article->module,
            'image' => $image,
        ]);
        $article->removeImage($image);
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        $image = $article->image;
        $this->debug('Removing the image', [
            'module' => $article->module,
            'image' => $image,
        ]);
        $article->removeImage($image);
    }

}
