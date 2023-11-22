<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

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
{
    // ... (seu código existente)

    $dados = $request->except('password');
    $senha = $request->input('password');
    $senhaCriptografada = Hash::make($senha);
    $dados['password'] = $senhaCriptografada;

    User::create($dados);

    // Obter o token usando Firebase JWT
    $usuario = User::where('email', $request->input('email'))->first();

    // Certifique-se de configurar corretamente a chave de API do Firebase no seu arquivo .env
    $apiKey = env('FIREBASE_API_KEY');

    // Verifique se a chave de API do Firebase está configurada corretamente
    if (empty($apiKey)) {
        return response()->json(['error' => 'Chave de API do Firebase não configurada.'], 500);
    }

    // Inclua as informações personalizadas no payload
    $tokenPayload = [
        'id' => $usuario->id_usuario,
        'nome' => $usuario->nome,
        'email' => $usuario->email,
    ];

    // Codifique o token com as informações personalizadas
    $token = JWT::encode($tokenPayload, $apiKey, 'HS256');

    return response()->json(['token' => $token], 200);
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

    public function fazerlogin(Request $request)
{
    $dados = $request->only('email', 'password');

    if (Auth::attempt($dados)) {
        // Obter o usuário autenticado
        $usuario = Auth::user();

        // Certifique-se de configurar corretamente a chave de API do Firebase no seu arquivo .env
        $apiKey = env('FIREBASE_API_KEY');

        // Verifique se a chave de API do Firebase está configurada corretamente
        if (empty($apiKey)) {
            return response()->json(['error' => 'Chave de API do Firebase não configurada.'], 500);
        }

        // Inclua as informações personalizadas no payload
        $tokenPayload = [
            'id' => $usuario->id_usuario,
            'nome' => $usuario->nome,
            'email' => $usuario->email,
        ];

        // Codifique o token com as informações personalizadas
        $token = JWT::encode($tokenPayload, $apiKey, 'HS256');

        // Retorne o token no JSON de resposta
        return response()->json(['token' => $token], 200);
    } else {
        return response()->json(['error' => 'Email ou senha incorretos'], 401);
    }
}
    public function logout(){
        Auth::logout();
        return 'voce saiu com sucesso';
    }

    public function token(){
        return csrf_token();
    }

    public function verContatos(){
        $user=Auth::user()->id;
        echo $user;
    }

    public function verificarEmail($email)
{
    $usuario = User::where('email', $email)->first();

    return response()->json(['existe' => $usuario !== null]);
}

public function getIdUsuarioByEmail($email) {
    // Procurar um usuário com o e-mail fornecido
    $usuario = User::where('email', $email)->first();

    if ($usuario) {
        return response()->json(['id_usuario' => $usuario->id_usuario]);
    } else {
        return response()->json(['error' => 'Usuário não encontrado'], 404);
    }
}
}