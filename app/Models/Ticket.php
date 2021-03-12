<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, SerializeDate;

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'email',
        'message',
    ];

}
