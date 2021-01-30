<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->except(['edit']);
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return response()->json([
            'message'  => 'Usuario creado con exito.!',
            'response' => true
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if($user->edit)
        {
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
            User::where('id', $id)->update($input);
            return response()->json([
                'message'  => 'Datos actualizados con exito.!',
                'response' => true
            ], 200);
        }
        else
        {
            return response()->json([
                'message'  => 'Disculpe, usted no tiene permiso para realizar esta operacion.!',
                'response' => false
            ], 200);
        }
        
    }

    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $token = $user->createToken('user_token')->accessToken;
            $user->save();
            return response()->json([
                'message'  => 'Bienvenido(a) '.$user->name,
                'token'    => $token,
                'response' => true
            ], 200);    
        }
        else
        {
            return response()->json([
                'message'  => 'Usuario o contrasena incorrecta.!',
                'response' => false
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json([
            'message'  => 'Sesion Cerrada.',
            'response' => true
        ], 200);
    }
}
