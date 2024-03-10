<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class AsignarPermisosARolController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:asignar permisos'])->only(['index']);
    }

    public function index(){


        $roles = Role::all();

        $permisos = Permission::orderBy('name','asc')->get();

        $result_permisos = [];

        //::::::::::: Sugerencia de zzzcode con ajustes personales

        $result_permisos = collect();

        $data =[];

        foreach ($permisos as $item) {
            // $categoria = implode(' ', array_slice($item->name, 1));

            $categoria = explode(' ', $item->name);
            $categoria = implode(' ', array_slice($categoria, 1));

            if (!$result_permisos->has($categoria)) {
                $result_permisos->put($categoria, collect());
            }

            $result_permisos->get($categoria)->push($item->name);
        }
        // return $result_permisos;

        //::::::::::::://

        // foreach ($permisos as $item) {
        //     $categoria = explode(' ', $item->name);
        //     // $categoria = end($categoria);

        //     if(count($categoria)==2){

        //         $categoria = $categoria[1];

        //     }else if(count($categoria)==3){

        //         $categoria = $categoria[1]." ".$categoria[2];

        //     }else if(count($categoria)==4){

        //         $categoria = $categoria[1]." ".$categoria[2]." ".$categoria[3];
        //     }

        //     if (!isset($result_permisos[$categoria])) {
        //         $result_permisos[$categoria] = [];
        //     }

        //     $result_permisos[$categoria][] = $item->name;

        // }
        // return $result_permisos;

        return view('asignar-permisos-rol.index', compact('roles','result_permisos'));


    }

    public function list($roleId)
    {
        $role = Role::findById($roleId);
        $permissions = $role->permissions;

        $resultado = [
            'status' => "0",
            'mensaje' =>'No existen permisos asignados a este rol',
        ];

        if($role){
            $resultado = [
                'status' => "1",
                'data'=> $permissions
            ];
        }

        return $resultado;


    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'rol'      => 'required',
            // 'permisos' => 'required|array'
        ]);

        $res = [
            'resultado' => 204,
            'status' => "0",
            'errors' => "No se ha seleccionado ningun permiso",
            'mensaje' =>'',
        ];

        if ($validator->fails()) {
            $res = [
				'resultado' => 422,
				'status' => "0",
				'errors' => $validator->errors(),
				'mensaje' =>'Hubo errores por validación',
			];
            return response()->json($res, 422);
        }

        $role = Role::findById($request->rol);

        $permissions = [];

        if($request->permisos){

            foreach ($request->permisos as $key => $value) {

                $permissions[]=[
                    Permission::findByName($value),
                ];
            }
            $role->syncPermissions($permissions);

            $res=[
                'resultado' => 202,
                'status' => "1",
                'errors' =>"",
                'mensaje' =>'Se actualizaron los permisos con el rol selecionado exitosamente',
            ];
        }

        return $res;

    }


}
