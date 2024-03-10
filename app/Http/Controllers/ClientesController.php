<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Clientes;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:ver clientes'])->only(['index']);
    }

    public function index()
    {
        $data = DB::table('vclientes')->get()->collect()->toArray();
        return view('clientes.clientes')->with('clientes', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        // Todo: Analiza  en una mejor opcion para que solo me traiga los cliente de la fecha seleccionada 

        $data = DB::table('vclientes')->select('id', 'nombre', 'telefono', 'email', 'rut', 'categoria', 'tipo', 'foto')->get();

        return $data;

        // $cls = $data;
        // foreach ($cls as $key => $cl) {
        //     $editar ="";
        //     $eliminar ="";

        //     if($user->can('editar clientes')){
        //         $editar = '<button class="btn btn-primary btn-sm edit-tbl" title="Editar" id="editar'.$data[$key]->id.'"><i class="fas fa-edit"></i></button>';
        //     }

        //     if($user->can('eliminar clientes')){
        //         $eliminar = '<button class="btn btn-danger btn-sm delete-tbl" title="Eliminar" id="eliminar'.$data[$key]->id.'"><i class="fas fa-trash"></i></button>';
        //     }

        //     $data[$key]->acciones = $editar . $eliminar;

        // }
        // return(json_encode($data));
    }

    public function list_clientes()
    {
        $clientes = Clientes::select('id', 'nombre')->distinct('nombre')->orderBy('nombre')->get();

        return $clientes;
    }

    public function list_clientes_select2(Request $request)
    {
        $clientes = Clientes::select('id', 'nombre')->distinct('nombre')->orderBy('nombre');
        if (isset($request->term) || isset($request->q)) {

            $busq = (isset($request->term)) ? $request->term : $request->q;

            $clientes = $clientes->where('nombre', 'LIKE', '%' . $busq . '%');
        }
        $clientes = $clientes->paginate(20);
        $clientes = json_decode(json_encode($clientes));
        $result = ['total_count' => $clientes->total, 'incomplete_results' => false, 'items' => $clientes->data];
        return $result;
    }


    public function list_clientes_por_fecha(Request $request)
    {
        // fecha
        // desde 
        // hasta
        $clientes = Reservas::select('nombre_cliente as nombre')

            ->when($request->has('fecha'), function ($query) use ($request) {
                return $query->where('fecha_reserva', $request->input('fecha'));
            })
            ->when($request->has('desde') && $request->has('hasta'), function ($query) use ($request) {
                return $query->where('fecha_reserva', ">=", $request->input('desde'))
                    ->where('fecha_reserva', "<=", $request->input('hasta'));
            })
            ->groupBy('nombre_cliente')->orderBy('nombre_cliente')->get();

        return $clientes;


        // ->when($request->has('fecha'), function ($query) use ($request) {
        //     return $query->where('fecha_reserva', $request->input('fecha'));
        // });

    }

    public function empresas()
    {
        $empresas = Clientes::select('empresa')->orderBy('empresa', 'asc')->whereNull('deleted_at')->distinct()->get();
        return (json_encode($empresas));
    }
    public function hoteles()
    {
        $hoteles = Clientes::select('hotel')->orderBy('hotel', 'asc')->whereNull('deleted_at')->distinct()->get();
        return (json_encode($hoteles));
    }
    public function telefonos()
    {
        $telefonos = Clientes::select('telefono')->orderBy('telefono', 'asc')->whereNull('deleted_at')->distinct()->get();
        return (json_encode($telefonos));
    }
    public function correos()
    {
        $correos = Clientes::select('email')->orderBy('email', 'asc')->whereNull('deleted_at')->distinct()->get();
        return (json_encode($correos));
    }

    public function buscar_cliente(Request $request)
    {
        $cliente = count(Clientes::select('nombre')->whereNull('deleted_at')->where('clientes.nombre', 'LIKE', '%' . $request->cliente . '%')
        ->when($request->has('telefono'), function ($query) use ($request) {
            return $query->orWhere('telefono', $request->input('telefono'));
        })
        ->when($request->has('email'), function ($query) use ($request) {
            return $query->orWhere('email', $request->input('email'));
        })
        
        ->get()->toArray());
        return json_encode(['respuesta' => $cliente]);
    }
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


    public function cliente_min(Request $request)
    {
        // dd($request->all());
        $existe = Clientes::where("nombre", "=", $request->data[1])
            ->where("telefono", "=", $request->data[4])
            ->where("email", "=", $request->data[5])
            ->where("empresa", "=", $request->data[2])
            ->where("hotel", "=", $request->data[3])
            // ->where("tipo_id","=",$request->data[0])
            ->get();
        $data = ([
            "nombre" => $request->data[1],
            "telefono" => $request->data[4],
            "email" => $request->data[5],
            "empresa" => $request->data[2],
            "hotel" => $request->data[3],
            // "tipo_id" => $request->data[0],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        try {
            $cliente = Clientes::insert($data);
            $mensaje = "Cliente creado exitosamente";
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' => $mensaje,
            ];
            return json_encode($res);
        } catch (\Exception $e) {
            unset($res);
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }
    public function store(Request $request)
    {
        $data = ([
            "nombre" => $request->nombre,
            "rut" => $request->rut,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "telefono" => $request->telefono,
            "direccion" => $request->direccion,
            "comuna_id" => $request->comuna,
            "categoria_id" => $request->categoria,
            "numero_tarjeta" => $request->numero_tarjeta,
            "email" => $request->email,
            "empresa" => $request->empresa,
            "hotel" => $request->hotel,
            "vino_favorito_1" => $request->vino_favorito_1,
            "vino_favorito_2" => $request->vino_favorito_2,
            "vino_favorito_3" => $request->vino_favorito_3,
            "foto" => $request->foto,
            "referencia" => $request->referencia,
            "info_vina" => 0,
            "club" => 0,
            "tipo_id" => $request->tipo,
        ]);
        try {
            $cliente = Clientes::firstOrCreate($data);
            $mensaje = "Cliente creado exitosamente";
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' => $mensaje,
            ];
            return json_encode($res);
        } catch (\Exception $e) {
            unset($res);
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $Clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    // public function edit(Clientes $Clientes) {
    public function edit($id)
    {
        $data = DB::table('vclientes')->where('id', '=', $id)->get()->collect()->toArray();
        return (json_encode($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientesController $ClientesController)
    {
        $data = ([
            "nombre" => $request->nombre,
            "rut" => $request->rut,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "telefono" => $request->telefono,
            "direccion" => $request->direccion,
            "comuna_id" => $request->comuna,
            "categoria_id" => $request->categoria,
            "numero_tarjeta" => $request->numero_tarjeta,
            "email" => $request->email,
            "empresa" => $request->empresa,
            "hotel" => $request->hotel,
            "vino_favorito_1" => $request->vino1,
            "vino_favorito_2" => $request->vino2,
            "vino_favorito_3" => $request->vino3,
            "foto" => $request->foto,
            "referencia" => $request->referencia,
            // "info_vina" => $request->info_vina,
            "club" => $request->club,
            "tipo_id" => $request->tipo,
            'updated_at' => Carbon::now(),
        ]);
        try {
            $mensaje = 'éxito';
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' => $mensaje,
            ];
            Clientes::where("id", "=", $request->id)->update($data);
            return ($res);
        } catch (\Exception $e) {
            unset($res);
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'mensaje' => 'error'
            ];
            return json_encode($res);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ([
            'deleted_at' => Carbon::now(),
        ]);
        try {
            $mensaje = 'éxito';
            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' => $mensaje,
            ];
            Clientes::where("id", "=", $id)->update($data);
            return json_encode($res);
        } catch (\Exception $e) {
            unset($res);
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'mensaje' => 'error'
            ];
            return json_encode($res);
        }
    }
}
