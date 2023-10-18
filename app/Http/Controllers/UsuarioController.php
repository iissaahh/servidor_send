<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {   $dados=$request->except('password');
        $senha=$request->input('password');
        $senhaCriptografada=Hash::make($senha);
        $dados['password']=$senhaCriptografada;
        User::create($dados);
        return "usuario criado!";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuarioController  $usuarioController
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioController $usuarioController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuarioController  $usuarioController
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioController $usuarioController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsuarioController  $usuarioController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->fill($request->all());
        $usuario->save();
        return "usuarios atualizados com sucesso!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuarioController  $usuarioController
     * 
     * 
     * 
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        User::destroy($usuario->id);
        return "usuario deletado com sucesso";
    }

    public function login(){
        return 'voce esta na tela de login';
    }

    public function fazerlogin(Request $request){
        $dados=$request->only('email','password');
        if(Auth::attempt($dados)){
            return 'logado com sucesso';
        }else{
            return 'email ou senha incorreto';
        }
    }
    public function logout(){
        Auth::logout();
        return 'voce saiu com sucesso';
    }

    public function token(){
        return csrf_token();
    }
}
