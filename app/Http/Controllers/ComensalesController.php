<?php

namespace App\Http\Controllers;

use App\Models\ResMesas;
use App\Models\Comensales;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\Funciones;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComensalesController extends Controller
{
    use Funciones;
    
    public function __construct(){

        $this->middleware(['auth', 'permission:ver comensales'])->only(['index']);
    }
    /**
     * Display a listing of the resource.   
     */
    //Listado 
    public function index()
    {
       return view('comensales.index');
    }

    public function list(){

        return Comensales::with('mesa:id,mesa')->orderBy('id','DESC')->get();
    }

    public function create()
    {
        $mesas= ResMesas::orderBy('mesa')->get();
       
        return view('comensales.create', compact('mesas'));

    }

    public function registro(){
        
        return view('comensales.registro');

    }

    public function mesa_crear(){    

        $mesas= ResMesas::orderBy('mesa')->get();        
        return view('comensales.mesa-crear', compact('mesas'));

    }

    public function mesa_unirse(){
        
        return view('comensales.mesa-unirse');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz'; 

        $tipo_registro = $request->tipo_registro;  
        $randomHash =  Str::lower(Str::random(6));

        if($tipo_registro==1){

            $validated = $request->validate([               
                'reserva_id'    => '',
                'mesa_id'       => '',
                'cuenta_id'     => '',                
                'nombre'        => 'required|max:60',
                'apellido'      => '',
                'email'         => 'required|email',
                'telefono'      => '',
                'birth_day'     => 'required',
            ]);

            $validated = array_merge($validated,['registro_hash'=> $randomHash]);
          

        }else{

            $validated = $request->validate([                
                'parent_registro_hash' => 'required|min:5|max:6|exists:comensales,registro_hash',              
                'nombre'               => 'required|max:60',
                'apellido'             => '',
                'email'                => 'required|email',
                'telefono'             => '',
                'birth_day'            => 'required',
            ]);

            // $busqueda =  Comensales::where('registro_hash', $request->parent_registro_hash)->count();

            // if($busqueda==0){

            //     return redirect()->back()->with('error_hash', "no existe en nuestra base el hash que ha colocado")->withInput();
            // }
        }  

        DB::beginTransaction();

        try {

            $comensal = Comensales::create($validated);
            DB::commit();

            $this->emailRegistroComensal($comensal, $tipo_registro);

            if($tipo_registro==1){

                $text_crea_mesa = "Su código: <b>{$randomHash}</b> este código le permitirá asociar a los comensales de la mesa donde se encuentra; igualmente le hemos enviado un email con este dato";
            
            }else{

                $text_crea_mesa = "Le hemos enviado un email con los datos de su registro";
            }

            return redirect()->back()->with('message', 'Registro guardado exitosamente. '.$text_crea_mesa);
            
        } catch (\Throwable $e) {

            DB::rollback();

            $res = [
                'resultado' => 500,
                'status'    => "0",
                'error'     => $e->getMessage(),
                'line'      => $e->getLine(),
                'file'      => $e->getFile(),
            ];

            return $res;
            
            return redirect()->back()->with('error_message', 'Ha ocurrido un error; no se puedo crear el registro');
        }

    }

    private function emailRegistroComensal($data, $tipo){

        $asunto = "Registro de comensal";
        $nombre = $data->nombre;

        $url = route('comensales.registro');

        $nacimiento = Carbon::parse($data->birth_day)->format('d-m-Y');
       

        $cuerpo= "<p align='center' style='padding:10px;'><img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' width='150px'></p>";

        $cuerpo.= "<p>Gracias por registrarse con nosostros.</p>";
        $cuerpo.= "<p><b>Datos:</b></p>";
        $cuerpo.= "<p>Nombres y Apellidos: {$data->nombre} {$data->apellido}</p>";
        $cuerpo.= "<p>Email: {$data->email} </p>";
        $cuerpo.= "<p>Teléfono: {$data->telefono} </p>";
        $cuerpo.= "<p>Fecha de nacimiento: {$nacimiento} </p>";       

        if($tipo == 1){
            $cuerpo.= "<p>Código: <b>{$data->registro_hash}</b> </p>";            
        }

        $cuerpo .="<br><p>Para un nuevo registro  haga click aquí: <a href='{$url}'>{$url}</a></p>";

        $cuerpo .="<p>Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>";

        $this->constructorEmail($asunto, $cuerpo, $data->email, $data->nombre." ".$data->apellido);  

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Comensales::find($id);  

        $res = [
            'resultado' => 404,
            'status' => "0",
            'error' =>'No existe este recurso',   
        ];
        
        if($data){

            $res = [
                'resultado' => 200,
                'status' => "1",
                'data' => $data,               
            ];
        }
       
        return $res;
        
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
        
        $validated = $request->validate([              
            'nombre'        => 'required|max:60',
            'apellido'      => '',
            'email'         => 'required|email',
            'telefono'      => '',
            'birth_day'     => 'required',
        ]);

        DB::beginTransaction();
        try {           

            $comensal = Comensales::find($id);           
    
            if($comensal){

                $comensal->update($validated);  
                DB::commit();
    
                $res = [
                    'resultado' => 201,
                    'status' => "1",
                    'mensaje'=>"Registro actualizado exitosamente",
                    'data' => $comensal,                
                ];

            }else{
                $res = [
                    'resultado' => 204,
                    'status' => "0",
                    'error'=> "Ah ocurrido un error, no existe el registro",
                    'mensaje'=>"No es posible realizar la actualización ",                        
                ];
            }

            return $res;

        } catch (\Throwable $e) {
            DB::rollback();
            $res = [
                'resultado' => 500,
                'status'    => "0",
                'error'     => $e->getMessage(),
                'line'      => $e->getLine(),
                'file'      => $e->getFile(),
            ];
            return $res;           
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
