<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagen extends Model
{
    use HasFactory;
    public $primaryKey= 'id_mensagem';

    protected $fillable=["id_conversas",'id_usuario_enviante','texto_mensagem','data_envio','hora_envio'];

    public function usuarios(){
        return $this->belongsTo(Usuario::class);
    }
    public function conversas(){
        return $this->belongsTo(Conversas::class);
    }
}
