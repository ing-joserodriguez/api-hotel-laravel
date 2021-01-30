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
        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            
            Obtengo la informacion que se va a guardar excluyendo el permiso de editar.
            Esto es asi ya que solo los usuarios con este permiso pueden asignarselo a otros usuarios. 
            Esto evita que cualquier persona se registre y se auto asigne el permiso para editar y pueda
            modificar la informacion.

        */
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
        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            
            Obtengo la informacion del usuario logueado y verifico si tiene permiso para editar.
            
            Si esta habilitado para realizar la operacion continua con el proceso normalmente.
            
            Si de lo contrario no tiene permiso para editar, pero el usuario quiere editar su propia informacion
            se le permite modificar, mas no podra auto asignarse el permiso para editar la informacion 
            de otros o de las habitaciones.

            De lo contrario no podra realziar ninguna operacion y se le retornara un mensaje indicando que no tiene el permiso
            para modificar los datos
        */
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
        elseif(!$user->edit && $user->id == $id)
        {
            $input = $request->except(['edit']);
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
        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            
            Obtengo la informacion del usuario a partir de su correo electronico.
            
            Y si el usuario existe y el password ingresado es correcto, se genera un token para ese
            usuario y se le envia un mensaje de bienvenida.

            De lo contrario se le envia un mensaje indicandole que su usuario o password son incorrectos.

        */
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
        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            
            Obtengo la informacion del usuario logueado.
            
            Obtengo todos los tokens que pueda tener activos, debido a que puede haber iniciado sesion
            desde varios dispositivos. Y los elimino uno por uno dentro de un ciclo.
            
            Y returna un mensaje indicando que la sesion ha sido cerrada.

        */
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
