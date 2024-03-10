<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CliCategoriaClientesSeeder::class,
            CliTiposClienteSeeder::class,
            CliComunasSeeder::class,
            GiftCreditosSeeder::class,
            GiftEstadoPagoSeeder::class,
            GiftEstadosSeeder::class,
            GiftFormaPagoSeeder::class,
            GiftMesonerosSeeder::class,
            ResEstadosReservasSeeder::class,
            ResSucursalesSeeder::class,
            ResSalonesSeeder::class,
            ResMesasSeeder::class,
            ResTipoReservaSeeder::class,
            ResRazonCancelacionSeeder::class,
            UsuarioReinaldoSeeder::class,
            RolesAndPermissionsSeeder::class,
            UsuarioAlbertoSeeder::class,
            UsuariosQASeeder::class,            
            UsuarioRolUsuarioSeeder::class,
            UserAdminRolSeeder::class,
            ConfTipoSeeder::class,
            VistaSeeder::class,
            GbAccionTiposSeeder::class,
            UserReservaPrincipalSeeder::class,
            ImportarReservaSeeder::class,
            UserAdminRolSeeder::class,
            UserProductionSeeder::class,

        ]);
    }
}
