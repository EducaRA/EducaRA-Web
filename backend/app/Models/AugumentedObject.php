<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AugumentedObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description','size', 'extension', 'url_download' 
    ];
}
