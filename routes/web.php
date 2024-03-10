<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

//** Para enviar get utilizando Cron Job */ 
Route::get('/giftcard/sincronizar_post', 'GiftcardController@get_sincronizar')->name('giftcard.get.sincronizar.post');// Envia data cada 1 minuto
Route::get('/giftcard/verifica-giftcards-email', 'GiftcardController@verificaGiftcarsEmail'); // Envia una vez al dia
//**************************************************** */

Route::post('login-button', [App\Http\Controllers\Auth\LoginButtonController::class, 'login'])->name('login.button');
//Language Translation
Route::get('/', [App\Http\Controllers\GraficaController::class, 'index'])->name('index');
Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
Route::get('/giftcard/giftcard_check/{codigo}', 'GiftcardController@giftcard_check')->name('giftcard_check');
Route::get('/giftcard/giftcard_check/{codigo}/canjear', 'GiftcardController@giftcard_check')->name('giftcard_check_canjear')->middleware('auth');
Route::get('reservar/reserva_check', 'ReservasController@reserva_check')->name('reservar.check');


Route::middleware([Authenticate::class])->group(function () {
	Route::prefix("clientes")->group(function () {
		Route::resource('/clientes', 'ClientesController', [
			'names' => [
				'index' => 'clientes'
			]
		]);
		Route::resource('/tipos', 'CliTiposClientesController', [
			'names' => [
				'index' => 'clientes.tipos'
			]
		]);
		Route::resource('/categorias', 'CliCategoriaClientesController', [
			'names' => [
				'index' => 'clientes.categorias'
			]
		]);
		Route::resource('/comunas', 'CliComunasController', [
			'names' => [
				'index' => 'clientes.comunas'
			]
		]);
		Route::get('/tiposlista', 'CliTiposClientesController@list')->name('tipos.lista');
		Route::get('/categoriaslista', 'CliCategoriaClientesController@list')->name('categorias.lista');
		Route::get('/comunaslista', 'CliComunasController@list')->name('comunas.lista');
		Route::get('/clienteslista', 'ClientesController@list')->name('clientes.lista');
		Route::get('/clientescategorias', 'CliCategoriaClientesController@list')->name('categorias.lista');
		Route::get('/clientestipos', 'CliTiposClientesController@list')->name('categorias.lista');
		Route::get('/clientescomunas', 'CliComunasController@list')->name('comunas.lista');
		Route::get('/clientesempresas', 'ClientesController@empresas')->name('clientes.empresas');
		Route::get('/clienteshoteles', 'ClientesController@hoteles')->name('clientes.hoteles');
		Route::get('/clientestelefonos', 'ClientesController@telefonos')->name('clientes.telefonos');
		Route::get('/clientescorreos', 'ClientesController@correos')->name('clientes.correos');
		Route::post('/buscarliente', 'ClientesController@buscar_cliente')->name('clientes.buscar_cliente');
		Route::post('/clientemin', 'ClientesController@cliente_min')->name('clientes.cliente_min');
		Route::get('/list_clientes_por_fecha', 'ClientesController@list_clientes_por_fecha')->name('clientes.list_clientes_por_fecha');
		Route::get('/list_clientes', 'ClientesController@list_clientes')->name('clientes.list_clientes');

		Route::get('/list_clientes2', 'ClientesController@list_clientes_select2')->name('clientes.list_clientes2');

		// Route::post('/cat','CliCategoriaClientesController@store')->name('clientes.cat');

	});
	Route::prefix("reservas")->group(function () {
		Route::resource('/sucursales', 'ResSucursalesController', [
			'names' => [
				'index' => 'reservas.sucursales'
			]
		]);
		Route::resource('/salones', 'ResSalonesController', [
			'names' => [
				'index' => 'reservas.salones'
			]
		]);
		Route::resource('/mesas', 'ResMesasController', [
			'names' => [
				'index' => 'reservas.mesas'
			]
		]);
		Route::resource('/tipos', 'ResTipoReservasController', [
			'names' => [
				'index' => 'reservas.tipos'
			]
		]);
		Route::resource('/estados', 'ResEstadosReservasController', [
			'names' => [
				'index' => 'reservas.estados'
			]
		]);
		Route::resource('/razones', 'ResRazonCancelacionController', [
			'names' => [
				'index' => 'reservas.razones'
			]
		]);
		Route::get('/sucursaleslista', 'ResSucursalesController@list')->name('sucursales.lista');
		Route::get('/saloneslista', 'ResSalonesController@list')->name('salones.lista');
		Route::get('/mesaslista', 'ResMesasController@list')->name('mesas.lista');
		Route::get('/reservassucursales', 'ResSucursalesController@list')->name('sucursales.lista');
		Route::get('/reservassalones', 'ResSalonesController@list')->name('salones.lista');
		Route::get('/reservasmesas', 'ResMesasController@list')->name('mesas.lista');
		Route::get('/salonessucursales/{id}', 'ResSalonesController@sucursal_salones')->name('salones.sucursal_salones');
		Route::get('/salonesmesas/{id?}', 'ResSalonesController@salones_mesas')->name('salones.salones_mesas');
		Route::get('/salonesmesascrm/{id}', 'ResSalonesController@salones_mesas_crm')->name('salones.salones_mesas_crm');
		Route::get('/tiposlista', 'ResTipoReservasController@list')->name('tipos.lista');
		Route::get('/estadoslista', 'ResEstadosReservasController@list')->name('estados.lista');
		Route::get('/razoneslista', 'ResRazonCancelacionController@list')->name('razones.lista');
		Route::post('/cliente', 'ReservasController@cliente')->name('reservas.cliente');
		// Route::get('/salonesmesas/{id}','ResSalonesController@sucursal_salones')->name('salones.sucursal_salones');

	});
	Route::prefix("reservar")->group(function () {
		Route::resource('/reservar', 'ReservasController', [
			'names' => [
				'index' => 'reservar'
			]
		]);

		Route::get('/reservar-tab', 'ReservasController@reservar_tab')->name('reservar.tab');

		Route::post('/verificarclave', 'ReservasController@verificar_clave')->name('verificar.verificar_clave');
		Route::get('/listado', 'ReservasController@lista')->name('reservar.listado');
		Route::get('/list', 'ReservasController@list')->name('reservar.list');
		Route::get('/tipos', 'ReservasController@tipos')->name('reservar.tipos');
		Route::get('/razones', 'ReservasController@razones')->name('reservar.razones');
		// Route::put('/cancelar','ReservasController@cancelar')->name('reservar.cancelar');
		Route::put('/cancelar', 'ReservasController@update_canc')->name('reservar.cancelar');
		Route::put('/rechazar', 'ReservasController@rechazo')->name('reservar.rechazar');
		Route::put('/aceptar', 'ReservasController@aceptar')->name('reservar.aceptar');
		Route::get('/estados', 'ReservasController@estados')->name('reservar.cambio_estado');
		Route::put('/cambio_estado', 'ReservasController@cambio_estado')->name('reservar.cambio_estado');
		Route::get('/historial', 'ReservasController@historial')->name('reservar.historial')->middleware('permission:ver historial');
		Route::get('/historial_cambios', 'ReservasController@historial_cambios')->name('reservar.historial_cambios');
		Route::get('/historial_cambio/{id}', 'ReservasController@historial_cambio')->name('reservar.historial_cambio');
		Route::get('/get_reserva/{id}', 'ReservasController@get_reserva')->name('reservar.get_reserva');
		Route::get('/registro_cambio/{id}', 'ReservasController@registro_cambio')->name('reservar.registro_cambio');
		Route::get('/get_bloqueos/{fecha}', 'ReservasController@get_bloqueos')->name('reservar.get_bloqueos');
		Route::get('/get_bloqueo/{fecha}', 'ReservasController@get_bloqueo')->name('reservar.get_bloqueo');
		Route::get('/get_bloq/{id}', 'ReservasController@get_bloq')->name('reservar.get_bloq');
		Route::post('/set_bloqueo', 'ReservasController@set_bloqueo')->name('reservar.set_bloqueo');
		Route::get('/check_bloqueo/{fecha}/{hora}', 'ReservasController@check_bloqueo')->name('reservar.check_bloqueo');
		Route::post('/check_bloq', 'ReservasController@check_bloq')->name('reservar.check_bloq');
		Route::get('/unset_bloqueo/{id}', 'ReservasController@unset_bloqueo')->name('reservar.unset_bloqueo');
		Route::get('/pax_fecha/{id}/{fecha}/{turno?}', 'ReservasController@pax_fecha')->name('reservar.pax_fecha');
		Route::get('/list_fecha/{fecha}', 'ReservasController@list_fecha')->name('reservar.list_fecha');
		Route::get('/get_turno_fecha/{fecha}/{turno}', 'ReservasController@get_turno_fecha')->name('reservar.get_turno_fecha');
		Route::get('/get_reservas_sucursal/{id}', 'ReservasController@get_reservas_sucursal')->name('reservar.get_reservas_sucursal');
		Route::get('/get_reservas_sucursal_fecha/{id}/{fecha}', 'ReservasController@get_reservas_sucursal_fecha')->name('reservar.get_reservas_sucursal_fecha');
		Route::get('/opc_filtro_reservas/{tipo}', 'ReservasController@opc_filtro_reservas')->name('reservar.opc_filtro_reservas');
		Route::get('/bloqueos', 'ReservasController@bloqueos')->name('reservar.bloqueos')->middleware('permission:ver bloqueos');
		Route::get('/extras', 'ReservasController@extras')->name('reservar.extras');
		Route::get('/listaextras', 'ReservasController@listaextras')->name('reservar.listaextras');
		Route::get('/listabloqueos', 'ReservasController@listabloqueos')->name('reservar.listabloqueos');
		Route::post('/actualizar', 'ReservasController@actualizar')->name('reservar.actualizar');
		Route::post('/borrar_archivo', 'ReservasController@borrar_archivo')->name('reservar.borrar.archivo');

		Route::post('/filtros', 'ReservasController@filtros')->name('reservar.filtros');
		Route::get('/valida_estado', 'ReservasController@valida_estado')->name('reservar.valida_estado');
		Route::get('rollback/{id}', 'ReservasController@rollback')->name('reservar.rollback');
		Route::get('auxiliares', 'ReservasController@auxiliares')->name('reservar.auxiliares');
		
	});

	Route::prefix("calendario")->group(function () {
		Route::resource('/calendario', 'CalendarioController', [
			'names' => [
				'index' => 'calendario'
			]
		]);
		Route::get('/evento_calendario', 'CalendarioController@evento_calendario')->name('reservar.evento_calendario');
		Route::get('/pax_fecha/{estado}/{turno}/{tipo}', 'CalendarioController@pax_fecha')->name('reservar.pax_fecha');
		Route::get('/tipos_mes/{fecha}', 'CalendarioController@tipos_mes')->name('reservar.tipos_mes');

	});
	Route::prefix("giftcard")->group(function () {
		Route::resource('/giftcard', 'GiftcardController', [
			'names' => [
				'index' => 'giftcard'
			]
		])->middleware(['permission:ver giftcards']);
		Route::resource('/qr', 'QRController', [
			'names' => [
				'index' => 'qr'
			]
		]);
		Route::get('/get_giftcard/{id}', 'GiftcardController@get_giftcard')->name('giftcard.get_giftcard');
		// Route::get('/evento_calendario','CalendarioController@evento_calendario')->name('reservar.evento_calendario');
		Route::get('/list', 'GiftcardController@list')->name('giftcard.list')->middleware(['permission:ver giftcards']);

		Route::get('/generar_qr', 'GiftcardController@generar_qr')->name('generar_qr');
		Route::get('/revisar_qr/{id}', 'GiftcardController@revisar_qr')->name('revisar_qr');
		Route::get('/auxiliares', 'GiftcardController@auxiliares')->name('auxiliares');
		Route::put('/anular_giftcard', 'GiftcardController@anular_giftcard')->name('anular_giftcard');
		Route::post('/canjear_giftcard', 'GiftcardController@canjear_giftcard')->name('canjear_giftcard');

		Route::post('/cambiar_estado', 'GiftcardController@cambiar_estado')->name('cambiar_estado');

		Route::get('/listar_mesoneros', 'GiftcardController@listar_mesoneros')->name('listar_mesoneros');

		Route::get('/filtros/{id}/{tipo}', 'GiftcardController@filtros')->name('filtros');

		Route::post('/cambiar_vencimiento', 'GiftcardController@cambiar_vencimiento')->name('giftcard.cambiar_vencimiento');
		Route::post('/enviar_email', 'GiftcardController@enviar_email')->name('giftcard.enviar_email');
		Route::get('/creacion_masiva', 'GiftcardController@creacion_masiva')->name('giftcard.creacion_masiva');
		Route::post('/guardar_masivo', 'GiftcardController@guardar_masivo')->name('giftcard.guardar_masivo');
		Route::get('/sincronizar', 'GiftcardController@sincronizar')->name('giftcard.sincronizar');
		Route::post('/sincronizar', 'GiftcardController@get_sincronizar')->name('giftcard.get.sincronizar');

		Route::get('/pagos', 'GiftPagosController@index')->name('giftcard.pagos');
		Route::get('/pagos_list', 'GiftPagosController@list')->name('giftcard.pagos.list');

		Route::get('/create_proceso_pago/{codigo}', 'GiftPagosController@create')->name('proceso.pago.create');
		Route::get('/proceso_pago/{codigo}', 'GiftPagosController@proceso_pago')->name('proceso.pago');
		Route::post('/store_proceso_pago', 'GiftPagosController@store_proceso_pago')->name('proceso.pago.store');
		Route::post('/update_proceso_pago', 'GiftPagosController@update_proceso_pago')->name('proceso.pago.update');
		Route::get('/update_proceso_pago', 'GiftPagosController@update_proceso_pago')->name('proceso.pago.update.get');

		Route::get('/buscar_giftcards/{session_id}', 'GiftcardController@buscarGiftcards')->name('giftcards.buscar');
		Route::get('/historial/{codigo}', 'GiftcardController@historial')->name('giftcards.historial');

	});

	Route::prefix("usuarios")->group(function () {
		Route::resource('/usuarios', 'UsersController', [
			'names' => [
				'index' => 'usuarios'
			]
		]);
		Route::get('/list', 'UsersController@list')->name('usuarios.list');
		// Route::get('/mostrar_permisos', 'UsersController@mostrarPermisos')->name('usuarios.mostar.permisos');
		// Route::get('/permisos', 'UsersController@permisos')->name('usuarios.permisos');
		// Route::get('/permisos_list', 'UsersController@permisosList')->name('usuarios.permisos.list');
		Route::get('/view-users', 'UsersController@viewUsers')->name('usuarios.view.users');


	});

	Route::resource('roles', 'RolesController');
	Route::get('/roles_list', 'RolesController@list')->name('roles.list');

	Route::resource('permisos', 'PermisosController');
	Route::get('/permisos_list', 'PermisosController@list')->name('permisos.list');

	Route::resource('asignar_permisos_rol', 'AsignarPermisosARolController');
	Route::get('/asignar_permisos_rol_list/{id}', 'AsignarPermisosARolController@list')->name('asignar-permisos-rol.list');

	Route::resource('/configuracion_global', 'ConfiguracionGlobalController');
	Route::get('/configuracion_global_list', 'ConfiguracionGlobalController@list')->name('configuracion-global.list');
	Route::get('/colum_list/{id?}', 'ConfiguracionGlobalController@columList')->name('configuracion-global.colum_list');

	Route::get('/configura_tipos', 'ConfiguracionGlobalController@tiposlist')->name('configuracion-global.tipos_list');
	Route::get('/configura_vistas', 'ConfiguracionGlobalController@vistasList')->name('configuracion-global.tipos_list');

	Route::resource('/confirmaciones', 'ResConfirmacionesController', [
		'names' => [
			'index' => 'confirmaciones.index'
		]
	]);
	Route::get('/confirmacioneslist', 'ResConfirmacionesController@list')->name('confirmaciones.list');
	Route::post('/confirmaciones-filtros', 'ResConfirmacionesController@filtros')->name('confirmaciones.filtros');

	// Route::post('/cat','CliCategoriaClientesController@store')->name('clientes.cat');
	// Route::get('/listado','ReservasController@index')->name('reservas.listado');
	Route::get('/administrar', 'ReservasController@crm')->name('administrar')->middleware(['permission:ver administrar', 'checkPasswordAdmin']);// Anteriormente CRM
	Route::post('/administrar', 'ReservasController@crm')->name('administrar.post')->middleware(['permission:ver administrar', 'checkPasswordAdmin']);// Anteriormente CRM
	Route::post('/administrar/admin_page', 'ReservasController@admin_page')->name('administrar.page');

	Route::get('/administrar/ver/{id}', 'ReservasController@ver')->name('administrar.ver')->middleware(['permission:ver administrar']);// Anteriormente CRM

	Route::post('crm_update_tipo/{id}', 'ReservasController@crmUpdateTipo')->name('crm.update.tipo');

	Route::post('actualiza_salon_mesa/{id}', 'ReservasController@actualiza_salon_mesa')->name('crm.update.salon_mesa');


	// Route::get('/confirmaciones','ResConfirmacionesController@index')->name('confirmaciones.index');
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::prefix('dashboard')->group(function () {
		Route::get('/timeline_reservas', 'DashboardController@timeline_reservas')->name('dashboard.timeline_reservas');
	});
	Route::get('email_enviado', 'EmailEnviadoController@index')->name('email.enviados')->middleware(['permission:ver email enviados']);
	Route::get('email_enviado_list', 'EmailEnviadoController@list');

});

Route::view('test-email', 'emails.giftcard-canjeada');


Route::prefix("comensales")->group(function () {
	Route::resource('comensales', 'ComensalesController', [
		'names' => [
			'index' => 'comensales'
		]
	]);
	Route::get('/list', 'ComensalesController@list')->name('comensales.list');
});

Route::get('registro_comensales', 'ComensalesController@registro')->name('comensales.registro');
Route::get('comensales-mesa_crear', 'ComensalesController@mesa_crear')->name('comensales.mesa_crear');
Route::get('comensales-mesa_unirse', 'ComensalesController@mesa_unirse')->name('comensales.mesa_unirse');
