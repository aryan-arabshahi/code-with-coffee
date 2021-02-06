<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'name',
        'category_id',
        'content',
        'cover',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
