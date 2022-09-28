<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{   
    use SoftDeletes;
    use HasFactory;

    protected $table = 'rooms';
    protected $fillable = [
        'code', 'owner', 'name'
    ];

    //Muitas salas pertencem a um ou muitos objetos (N,N)
    public function augmentedObjects(){
        return $this->BelongsToMany(AugmentedObject::class);
    }

    // uma sala pertencem a apenas uma disciplina obrigatória
    public function discipline()
    {
       return $this->belongsTo(Discipline::class);
    }
    
    // uma sala possui nenhum ou vários participantes
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participate', 'room_id', 'participant_id');
    }

      // uma sala possui um dono obrigatório
    public function owner(){
        return $this->hasOne(User::class, 'id', 'owner');
    }
}
