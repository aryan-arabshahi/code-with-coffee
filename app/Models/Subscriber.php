<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory, SerializeDate;

    protected $table = 'subscribers';

    protected $fillable = [
        'email',
        'status',
    ];

}
