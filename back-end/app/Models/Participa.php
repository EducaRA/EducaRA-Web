<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participa extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'participa';
    protected $fillable = ['user_id', 'sala_id'];

    //Muitas disciplinas pertencem a um ou muitos objetos (N,N)
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function salas(){
        return $this->belongsTo(Sala::class);
    }
}
