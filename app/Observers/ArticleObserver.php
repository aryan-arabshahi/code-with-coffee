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
     */
    public function updated(Article $article)
    {
        $original_image = $article->getOriginal('image');
        // Checking the image change
        if ($original_image == $article->image) { return; }
        $this->debug('Removing the image', [
            'module' => $article->getModuleName(),
            'image' => $original_image,
        ]);
        $article->removeImage($original_image);
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
            'module' => $article->getModuleName(),
            'image' => $image,
        ]);
        $article->removeImage($image);
    }

}
