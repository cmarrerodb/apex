<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:ver permisos'])->only(['index']);
    }

    public function index()
    {
        return view('permisos.permisos');
    }

    public function list(){
        return Permission::orderBy('name','asc')->get();
    }

    public function store(Request $request)
    {
        $data = ([
            "name" => $request->name,
        ]);

        try {
            Permission::create($data);

                $res[] = [
                    'resultado' => 202,
                    'status' => "1",
                    'error' => '',
                    'mensaje' =>"Permiso creado exitosamente",
                ];
        } catch (\Throwable $e) {

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

    }

    public function edit($id)
    {
        return Permission::findOrfail($id);
    }


    public function update(Request $request, $id)
    {
        $data = ([
            "name" => $request->name,
        ]);

        try {

            $permission = Permission::findOrfail($id);
            $permission->update($data);

            $res[] = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>"Permiso actualizado exitosamente",
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
        // Permission::find(1)->delete();

        $permiso = Permission::findByIdOrFail($id);
        $permiso->delete();

        $res[] = [
            'resultado' => 202,
            'status' => "1",
            'error' => '',
            'mensaje' =>"Permiso eliminado exitosamente",
        ];

        return json_decode($res);

    }
}
