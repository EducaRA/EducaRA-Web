<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'disciplinas';
    protected $fillable = [
        'nome', 'sigla'
    ];

    //Muitas disciplinas pertencem a um ou muitos objetos (N,N)
    public function objetos(){
        return $this->BelongsToMany(Objeto::class);
    }

    //Disciplina tem muitas salas
    public function salas()
    {
        return $this->hasMany(Sala::class);
    }
}
