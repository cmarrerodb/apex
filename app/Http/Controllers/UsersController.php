<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;




class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:ver usuarios'])->only(['index']);
    }

    public function index()
    {
        return view('usuarios.usuarios');
    }

    public function list(){

        return User::with('roles')->orderBy('name','asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'username' => ['required', 'string','unique:users'],           
            'password' => ['required','min:8', 
                // Rule::unique('users')->where(function ($query) use ($request) {
                //     return $query->where('password','!=', Hash::make($request->password));
                // })                
            ]
                
        ]);
        // $datos=[
        //     'password'=> $request->input('password'),
        //     'hash_password' => Hash::make($request->input('password')),
        // ];
        // return $datos;

        // $usuarios = User::where('password', '=', Hash::make($request->input('password')))->get();

        // return $usuarios;

        // Todo: momentaneamente puede quedar asi, la otra es es que valida por el password que no este encriptado.

        $valor = 0;
        $users_valida = User::select('id','password')->get();
        foreach ($users_valida as $key => $value) {

            if(Hash::check($request->password, $value->password)){
                $valor = 1;                
                break;
            }
        }

        if($valor == 1){
            $res = [
				'resultado' => 422,
				'status' => "0",
				'errors' => [
                    'password'=>[
                        'La contraseña no puede ser igual a otra.'
                    ],                        
                ],
				'mensaje' =>'Hubo algunos errores por validaciones',
			];
            return response()->json($res, 422);
        }
        

        if ($validator->fails()) {
            $res = [
				'resultado' => 422,
				'status' => "0",
				'errors' => $validator->errors(),
				'mensaje' =>'Hubo alguno errores por validaciones',
			];
            return response()->json($res, 422);
        }

        $data = ([
            "name"            => $request->name,
            "email"           => $request->email,
            'username'        => $request->username,
            "avatar"          => "avatar1.png",
            "noti_prereserva" => $request->noti_prereserva == "si"?true: false,
            "noti_reserva"    => $request->noti_reserva    == "si"?true: false,
            "password"        => Hash::make($request->password ),
            "giftcard_ver"    => $request->giftcard_ver,
            "giftcard_crear"  => $request->giftcard_crear,
            "giftcard_anular" => $request->giftcard_anular,
            'password_old'    => $request->password
        ]);

        try {
            $user= User::firstOrCreate($data);

            $user->assignRole($request->role);
            $res = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' => "Usuario creado exitosamente"
            ];

            return json_encode($res);

        } catch(\Exception $e) {
            $res = [
                'resultado' => 500,
                'status' => "0",
                'mensaje'=> 'Ha ocurrido un error 500',
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return $user;

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
        // return request->all();

        $user = User::find($id);        

        $validator = Validator::make($request->all(), [
            'name'     => 'required',            
            'email'    => 'required|email|unique:users,email,'.$user->id,           
            'username' => 'required|unique:users,username,'.$user->id,            
            'password' => [
                'nullable',
                'string',
                'min:8',                
                // Rule::unique('users')->ignore($user->id)->where(function ($query) use ($request) {
                //     return $query->where('password_old', '!=',$request->password);
                // }),  
                // $query = User::where(function ($query) use ($user, $request) {
                //    return $query->where('id', '!=', $user->id)->where('password', '!=' ,Hash::make($request->password));
                // }),      
               
                // function ($attribute, $value, $fail) use ($user, $request) { 
                   
                //     if ( Hash::check($request->password, $user->password)) {
                //     // if ( $value == $user->password_old) {

                //         $fail(__('La contraseña no puede ser igual a otra.')); 
                //     } 
                // }, Rule::unique('users')->ignore($user->id)
                
            ], 
             
        ]);

        $valor = 0;
        $users_valida = User::where('id', '!=', $user->id)->get();

        foreach ($users_valida as $key => $value) {

            if(Hash::check($request->password, $value->password)){
                $valor = 1;                
                break;
            }
        }

        if($valor == 1){
            $res = [
				'resultado' => 422,
				'status' => "0",
				'errors' => [
                    'password'=>[
                        'La contraseña no puede ser igual a otra.'
                    ],                        
                ],
				'mensaje' =>'Hubo algunos errores por validaciones',
			];
            return response()->json($res, 422);
        }

        if ($validator->fails()) {
            $res = [
				'resultado' => 422,
				'status' => "0",
				'errors' => $validator->errors(),
				'mensaje' =>'Hubo algunos errores por validaciones',
			];
            return response()->json($res, 422);
        }

        $data = ([
            "name" => $request->name,
            "email" => $request->email,
            'username'=> $request->username,
            "noti_prereserva" => $request->noti_prereserva=="si"?true:false,
            "noti_reserva" => $request->noti_reserva=="si"?true:false,
            "giftcard_ver"    => $request->giftcard_ver,
            "giftcard_crear"  => $request->giftcard_crear,
            "giftcard_anular" => $request->giftcard_anular,
            
        ]);

        if($request->password){
            $data['password'] = Hash::make($request->password );
            $data['password_old'] = $request->password;
        }

        try {

            User::where("id","=",$request->id)->update($data);        

            // Elimino todos los roles que tenga
            $user->syncRoles([]);
    
            // Le creo un nuevo rol
            $user->assignRole($request->role);

            $mensaje = "Usuario Actualizado";
            $res = [
                'resultado' => 202,
                'status' => "1",
                'error' => '',
                'mensaje' =>'Usuario actualizado exitosamente'
            ];
            return json_encode($res);

        } catch(\Exception $e) {
            $res = [
                'resultado' => 500,
                'status' => "0",
                'mensaje'=> 'Ha ocurrido un error 500',
                'error' => $e->getMessage(),
            ];
            return json_encode($res);
        }

      

        return($data);


    }
    public function mostrarPermisos()
    {
        // $permissions = Permission::all();
        // return $permissions;
        // $usuario = User::findOrFail(1);


        // return view('mostrar-permisos', compact('permissions'));

        $usuario = User::findOrFail(5);
        $permiso = Permission::where('name', 'asignar permisos')->firstOrFail();
        $usuario->givePermissionTo($permiso);

        $permisos = $usuario->getPermissionsViaRoles();
        return $permisos;
    }



    public function roleSave(Request $request){

        if($request->id){

        }


    }

    public function permisos(){
        return view('usuarios.permisos');
    }

    public function permisosList(){
        return Permission::all();
    }

    public function validarUsername(Request $request){

        $request->validate([
            'username' => ['required', 'username', Rule::unique('users')],
        ]);

        $request->validate([
            'username' => ['required', 'username', Rule::unique('users')->ignore($user->id)],
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        DB::beginTransaction();

        try {
            $user = User::findOrfail($id);
            $user->delete();

            $result = [
                'resultado' => 204,
                'status'    => "0",
                'error'     => 'No se pudo eliminar el usuario seleccionado',
            ];

            if($user){

                $result = [
                    'resultado' => 201,
                    'status'    => "1",
                    'mensaje'   => "Usuario eliminado correctamente",            
                ];
            }

            DB::commit();

            return $result;

        } catch (\Throwable $e) {
            
           $result = [
                'resultado' => 204,
                'status' => "0",
                'error' => $e->getMessage(),
            ];
            DB::rollback();
            return json_encode($result);

        }
       
    }

    // Funcion para proba el  tiempo de ejecución 
    // Dio como resultado una media de 3 segundos localmente

    public function viewUsers(){
        $users = User::get();

        $data=[];
        foreach ($users as $key => $user) {            

            if(Hash::check('12345678', $user->password)){
                $valor = 1;   
                $data[]=$user;            
                break;
            }
        }
        return $data;
    }
}
