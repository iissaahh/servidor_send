<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    use HasFactory;
    public $primaryKey='id_conversas';

    protected $fillable=["id_conversas",'usuario1','usuario2'];
    
}
