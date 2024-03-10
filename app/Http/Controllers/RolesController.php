<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:ver roles'])->only(['index']);
    }

    public function index()
    {

        $permisos = Permission::orderBy('name','asc')->get();

        $resultados = [];

        foreach ($permisos as $item) {
            $categoria = explode(' ', $item->name);
            $categoria = end($categoria);

            if (!isset($resultados[$categoria])) {
                $resultados[$categoria] = [];
            }

            $resultados[$categoria][] = $item->name;
        }

        return view('roles.roles', compact('permisos','resultados'));
    }

    public function list(){
        return Role::all();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $data = ([
            "name" => $request->name,
        ]);

        try {

            // Todo falta validaciones

            // $rol = Role::findByName($request->name);

            // if(count($rol)==0){

                Role::create($data);

                $res[] = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                    'mensaje' =>"Rol creado exitosamente",
                ];
            // }else{
            //     $res[] = [
            //         'resultado' => 400,
            //         'status' => "0",
            //         'mensaje' =>"El rol ya existe por favor intente con otro nombre de rol",
            //     ];
            // }

            return json_encode($res);
        } catch(\Exception $e) {
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return Role::findOrfail($id);

    }


    public function update(Request $request, $id)
    {
        $data = ([
            "name" => $request->name,
        ]);

        try {

            $rol = Role::findOrfail($id);
            $rol->update($data);

            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>"Rol actualizado exitosamente",
            ];

            return json_encode($res);
        } catch(\Exception $e) {
            $res[] = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }


    public function destroy($id)
    {

        $role = Role::findOrFail($id);
        $role->delete();


    }
}
