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
}
