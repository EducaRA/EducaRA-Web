<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto3d extends Model
{
    use HasFactory;
    protected $table = 'objetos_3d';

    protected $fillable = [
        'nome', 'descricao', 'size', 'extension', 'path', 'escala'
    ];
}
