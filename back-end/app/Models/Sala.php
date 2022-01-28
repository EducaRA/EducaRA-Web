<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'salas';
    protected $fillable = [
        'codigo', 'sala_id', 'dono'
    ];

    //Muitas salas pertencem a um ou muitos objetos (N,N)
    public function objetos(){
        return $this->BelongsToMany(Objeto::class);
    }

    // uma sala pertencem a apenas uma disciplina
    public function disciplina()
    {
       return $this->belongsTo(Disciplina::class);
    }
    //
    public function participantes()
    {
        return $this->belongsToMany(User::class, 'participa');
    }

    public function dono(){
        return $this->hasOne(User::class, 'id', 'dono');
    }
}
