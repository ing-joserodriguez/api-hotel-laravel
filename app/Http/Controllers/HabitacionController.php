<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\TipoHabitacion;
use App\Models\Reservacion;
use App\Models\Cliente;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            Obtengo los datos de las habitaciones, y de los clientes de manera separada,
            dejando la columna 'habitacion_id' como punto de asociacion entre ambos objetos.
        */
        $habitaciones = Habitacion::join('tipos_habitacion AS th', 'h.tipo_habitacion_id', '=', 'th.tipo_habitacion_id')
            ->select('habitacion_id', 'h.nombre', 'th.nombre AS tipo', 'h.estado')
            ->get();

        $clientes = Reservacion::join('clientes AS c', 'r.cliente_id', '=', 'c.cliente_id')
            ->select('r.habitacion_id','r.reservacion_id' ,'c.cliente_id', 'c.nombre_completo', 'r.check_in', 'r.check_out')
            ->get();

        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            Recorro los objetos obtenidos anteriormente, y mediante la columna 'habitacion_id' los
            relaciono entre si. Al objeto 'habitaciones' le asigno la informacion de los clientes
            que corresponda, usando el indice 'key' correspondiente a la iteracion.
        */
        if(!empty($habitaciones))
        {
            foreach($habitaciones as $key => $habitacion)
            {
                $data = array();
                $habitacion_id = $habitacion->habitacion_id;
                $habitacion->estado = $habitacion->estado == true ? 'Disponible' : 'Ocupada';

                foreach($clientes as $cliente)
                {
                    if($habitacion_id == $cliente->habitacion_id)
                    {
                        $data[] = array(
                            "reservacion_id" => $cliente->reservacion_id,
                            "cliente_id"     => $cliente->cliente_id,
                            "cliente"        => $cliente->nombre_completo,
                            "desde"          => $cliente->check_in,
                            "hasta"          => $cliente->check_out
                        );
                    }
                        
                }

                $habitaciones[$key]->reservaciones = $data;
            }
        }

        return response()->json($habitaciones, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
            Nombre: Jose Rodriguez
            Fecha: 29-01-2021
            Obtengo la informacion del usuario logueado y verifico si tiene permiso para editar.
            Si esta habilitado para realizar la operacion continua con el proceso normalmente. De lo
            contrario no se procesan los cambios y retorno un mensaje indicando que no tiene el permiso
            para modificar los datos.
        */
        $user = auth()->user();
        if($user->edit)
        {
            $input = $request->all();
            Habitacion::where('habitacion_id', $id)->update($input);
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
