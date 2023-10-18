<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagen extends Model
{
    use HasFactory;

    public function usuarios(){
        return $this->belongsTo(Usuario::class);
    }
    public function conversas(){
        return $this->belongsTo(Conversas::class);
    }
}