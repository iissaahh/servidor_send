<?php

namespace App\Http\Controllers;

use App\Models\Mensagen;
use Illuminate\Http\Request;

class MensagensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Mensagen::all();
    }

    public function minhasMensagens(Request $request){
        return $users = \DB::table('mensagens')
            ->join('conversas', 'mensagens.id_conversas', '=', 'conversas.id_conversas')
            ->join('usuarios AS u1', 'conversas.usuario1', '=', 'u1.id_usuario')
            ->join('usuarios AS u2', 'conversas.usuario2', '=', 'u2.id_usuario')
            ->where('mensagens.id_conversas','=', 1)
            ->select('texto_mensagem','hora_envio','u1.nome','u2.nome')
            ->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mensagen::create($request->all());
        return 'mensagem criada com sucesso';
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

    public function obterMensagensPorConversa($idConversa) {
        $mensagens = \DB::table('mensagens')
            ->where('id_conversas', $idConversa)
            ->select('id_mensagem', 'id_conversas', 'id_usuario_enviante', 'texto_mensagem', 'data_envio', 'hora_envio', 'created_at', 'updated_at')
            ->get();
    
        return response()->json($mensagens);
    }
    
}
