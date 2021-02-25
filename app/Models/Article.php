<?php

namespace App\Models;

use App\Models\Category;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasImage;

    protected $table = 'articles';

    /**
     * The module name used in the HasImage trait
     */
    protected $module = 'articles';

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'content',
        'description',
        'image',
        'status',
    ];

    protected $appends = [
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
