<?php

namespace App\Http\Controllers;

use App\Models\Conversas;
use App\Models\Mensagen;
use Illuminate\Http\Request;

class ConversasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Conversas::all();
    }

    public function conversasUsuario($id) {
        $conversas = \DB::table('conversas')
            ->join('usuarios', 'usuarios.id_usuario', '=', 'conversas.usuario2')
            ->leftJoin('mensagens', 'mensagens.id_conversas', '=', 'conversas.id_conversas')
            ->where('conversas.usuario1', $id)
            ->select(
                'usuarios.nome',
                'conversas.id_conversas',
                \DB::raw('MAX(mensagens.data_envio) as ultima_data_envio'),
                \DB::raw('MAX(mensagens.hora_envio) as ultima_hora_envio')
            )
            ->groupBy('usuarios.nome', 'conversas.id_conversas')
            ->get();
    
        return $conversas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados=$request->all();
        Conversas::create($dados);
        return 'conversa criado com sucesso';
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verificarConversa($usuario1, $usuario2)
    {
        $conversa = Conversas::where(function ($query) use ($usuario1, $usuario2) {
            $query->where('usuario1', $usuario1)
                ->where('usuario2', $usuario2);
        })->orWhere(function ($query) use ($usuario1, $usuario2) {
            $query->where('usuario1', $usuario2)
                ->where('usuario2', $usuario1);
        })->get();

        return response()->json($conversa);
    }
    public function obterNomeContato($id_conversas, $id_usuario_enviante)
    {
        $nomeContato = \DB::table('conversas')
            ->where('id_conversas', $id_conversas)
            ->where(function ($query) use ($id_usuario_enviante) {
                $query->where('usuario1', $id_usuario_enviante)
                      ->orWhere('usuario2', $id_usuario_enviante);
            })
            ->join('contatos', function ($join) use ($id_usuario_enviante) {
                $join->on('conversas.usuario1', '=', 'contatos.id_usuario')
                     ->where('conversas.usuario2', '=', $id_usuario_enviante)
                     ->orWhere('conversas.usuario2', '=', 'contatos.id_usuario')
                     ->where('conversas.usuario1', '=', $id_usuario_enviante);
            })
            ->value('contatos.nome');

        return response()->json(['nome_contato' => $nomeContato]);
    }

}
