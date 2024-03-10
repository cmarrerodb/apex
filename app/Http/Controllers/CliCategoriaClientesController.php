<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\CliCategoriaClientes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CliCategoriaClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:ver categoria de clientes'])->only(['index']);
    }
    public function index()
    {
        $categorias = CliCategoriaClientes::all('id','categoria','monto');
        $data = [];
        foreach ($categorias as $key => $categoria) {
            $data[$key]['id'] = $categoria['id'];
            $data[$key]['categoria'] = $categoria['categoria'];
            $data[$key]['monto'] = $categoria['monto'];
        }
        return view('clientes.categorias')->with('categorias',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        
        $categorias = CliCategoriaClientes::all('id','categoria','monto');
        return $categorias;
   
    }
    

    public function store(Request $request) {
        $data = ([
            'categoria' => strtoupper($request->categoria),
            'monto' => strtoupper($request->monto),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        try {
            CliCategoriaClientes::create($data);
			$mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            dd($res);
            return(json_encode($res));
		} catch(\Exception $e) {
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
     * Display the specified resource.
     *
     * @param  \App\Models\CliCategoriaClientes  $CliCategoriaClientes
     * @return \Illuminate\Http\Response
     */
    public function show(CliCategoriaClientes $CliCategoriaClientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CliCategoriaClientes  $CliCategoriaClientes
     * @return \Illuminate\Http\Response
     */
    public function edit(CliCategoriaClientes $CliCategoriaClientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CliCategoriaClientes  $CliCategoriaClientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CliCategoriaClientesController $CliCategoriaClientesController) {
        $data = ([
            'categoria' => strtoupper($request->categoria),
            'monto' => strtoupper($request->monto),
            'updated_at' => Carbon::now(),
        ]);
        try {
            CliCategoriaClientes::where("id","=",$request->id)->update($data);
            $mensaje = 'éxito';
			$res[] = [
				'resultado' => 202,
				'status' => "1",
				'error' => '',
				'mensaje' =>$mensaje,
			];
            return($res);
		} catch(\Exception $e) {
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
     * @param  \App\Models\CliCategoriaClientes  $CliCategoriaClientes
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
				'mensaje' =>$mensaje,
			];
            CliCategoriaClientes::where("id","=",$id)->update($data);
            return json_encode($res);
		} catch(\Exception $e) {
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
