<?php

namespace Modules\Movie\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class movie extends Model
{
    use HasFactory;

    protected $fillable = [

        
    ];
    
    protected static function newFactory()
    {
        return \Modules\Movie\Database\factories\MovieFactory::new();
    }
}
