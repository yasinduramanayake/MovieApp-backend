<?php

namespace Modules\Movie\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','theaters','type','image'];

    protected $casts = [
        'theaters' => 'array',
    ];
}
