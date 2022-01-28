<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objeto extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $table = 'objetos';
    protected $fillable = [
        'nome', 'descricao', 'filehash', 'size', 'extension','path'
    ];

    //Muitos objetos pertencem a uma ou muitas disciplinas (N,N)
    public function disciplinas(){
        return $this->BelongsToMany(Disciplina::class);
    }

    //Muitos objetos pertencem a uma ou muitas salas (N,N)
    public function salas(){
        return $this->BelongsToMany(Sala::class);
    }

}
