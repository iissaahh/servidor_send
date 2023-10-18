<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    use HasFactory;
    protected $fillable=["mensagem"];
    public function aux_conv_usuarios(){
        return $this->hasMany(aux_conv_usuarios::class);
    }
}
