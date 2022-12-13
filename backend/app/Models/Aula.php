<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aula extends Model
{   
    use SoftDeletes;
    use HasFactory;

    protected $table = 'aulas';
    protected $fillable = [
        'codigo', 'dono', 'nome', 'observacao', 'turma'
    ];

    //Muitas salas pertencem a um ou muitos objetos (N,N)
    public function objetos3d(){
        return $this->hasMany(Objeto3d::class);
    }

    // uma sala pertencem a apenas uma disciplina obrigatória
    public function disciplina()
    {
       return $this->belongsTo(Disciplina::class);
    }
    
      // uma sala possui um dono obrigatório
    public function dono(){
        return $this->hasOne(User::class, 'id', 'dono_id');
    }
}
