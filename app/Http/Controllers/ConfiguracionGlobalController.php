<?php

namespace App\Http\Controllers;

use App\Models\Vista;
use App\Models\ConfTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ConfiguracionGlobal;
use Illuminate\Support\Facades\Validator;

class ConfiguracionGlobalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:ver configuraciones globales'])->only(['index']);
    }

    public function index()
    {
        // $vistas = Vista::select('id','vista')->get();
        // $conf_tipos = ConfTipo::orderBy('nombre','asc')->get();
        return view('configuracion.index');

    }

    public function list(){

        $result = ConfiguracionGlobal::with(['tipo','vista'])->orderBy('id','DESC')->get();
        return $result;

    }


    public function create()
    {
        return view('configuracion.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
           
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'tipo_id' => 'required',            
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'resultado' => 422,
                    'status'    => "0",
                    'errors' => $validator->errors(),
                ], 422);
            }
    
            $config = new ConfiguracionGlobal;
            $config->name     = $request->name;
            $config->tipo_id  = $request->tipo_id;

            if($request->tipo_id==3){ // Si es Columnas
                // recibo la data de las columnas
            }
            $config->vista_id = $request->vista_id;
            $config->valor    = $request->valor;
            $config->duracion = $request->duracion;
            $config->email    = $request->email;
            $config->activo  =  $request->has('activoCheckChecked')?1:0;
            $config->save();  

            DB::commit();   

            $res = [
                'resultado' => 202,
                'status' => 1,
                'error' => "" ,               
            ];

            return json_encode($res);
            
            
        } catch (\Throwable $e) {
            $res = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];

            DB::rollback();

            return json_encode($res);
        }

    }


    public function show(ConfiguracionGlobal $configuracionGlobal)
    {
        return $configuracionGlobal;
    }


    public function edit(ConfiguracionGlobal $configuracionGlobal)
    {
        return view('configuracion-global.edit');
    }


    public function update(Request $request, ConfiguracionGlobal $configuracionGlobal)
    {
    

        // dd(request()->all());

        DB::beginTransaction();
        try {
           
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'tipo_id' => 'required',            
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'resultado' => 422,
                    'status'    => "0",
                    'errors' => $validator->errors(),
                ], 422);
            }    
            
            $configuracionGlobal->name     = $request->name;
            $configuracionGlobal->tipo_id  = $request->tipo_id;

            if($request->tipo_id==3){ // Si es Columnas
                // recibo la data de las columnas
            }
            $configuracionGlobal->vista_id    = $request->vista_id;
            $configuracionGlobal->valor       = $request->valor;
            $configuracionGlobal->duracion    = $request->duracion;
            $configuracionGlobal->email       = $request->email;
            $configuracionGlobal->descripcion = $request->descripcion;
            $configuracionGlobal->activo  =  $request->has('activoCheckChecked')?1:0;
            $configuracionGlobal->save();  

            DB::commit();   

            $res = [
                'resultado' => 202,
                'status' => 1,
                'error' => "" ,               
            ];

            return json_encode($res);
            
            
        } catch (\Throwable $e) {
            $res = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
                'line'=> $e->getLine(),
                'file'=> $e->getFile(),
            ];

            DB::rollback();

            return json_encode($res);
        }
    }

    public function columList($id=""){

        if($id){

            //Todo: Se puede mejorar agregando columna adicional de tabla o vista en la tabla vistas
            if($id== 1 || $id==2){
                $table_name = 'vreservas'; // nombre de la tabla
            }else if($id== 3 ){
                $table_name = 'res_extras'; // nombre de la tabla
            }
            else if($id== 4 ){
                $table_name = 'res_bloqueos'; // nombre de la tabla
            }
            // $column_names = DB::getSchemaBuilder()->getColumnListing($table_name);
            $column_names = DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = ? AND column_name NOT IN ('created_at', 'updated_at', 'deleted_at') ORDER BY ordinal_position ", [$table_name]);
            return $column_names;
        }else{
            return "";
        }

    }

    public function tiposList(){
        $data = ConfTipo::get();
        return $data;

    }

    public function vistasList(){
        $data = Vista::get();
        return $data;
    }


    public function destroy(ConfiguracionGlobal $configuracionGlobal)
    {
        //
    }


}
