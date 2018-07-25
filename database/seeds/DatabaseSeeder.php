<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nb_name'         => 'admin',
            'lo_bloqueado'    => '1',
        ]);

        DB::table('roles')->insert([
            'nb_name'         => 'vendedor',
            'lo_bloqueado'    => '1',
        ]);

        DB::table('roles')->insert([
            'nb_name'         => 'cliente',
            'lo_bloqueado'    => '1',
        ]);

        DB::table('menus')->insert([
            'nb_name'    => 'Cotizar',
            'nb_icon'    => 'fa fa-money',
            'nb_slug'    => 'cotizar',
            'nu_order'   => '0',
            'lo_enabled' => '1',
        ]);

        DB::table('menus')->insert([
            'nb_name'    => 'Cargar Productos',
             'nb_icon'   => 'fa fa-upload',
            'nb_slug'    => 'cargarProductos',
            'nu_order'   => '2',
            'lo_enabled' => '1',
        ]);

        DB::table('permisos')->insert([
            'fk_menus_permisos_co_menu' => '1',
            'fk_roles_permisos_co_rol'  => '1',
        ]);

        DB::table('permisos')->insert([
            'fk_menus_permisos_co_menu' => '2',
            'fk_roles_permisos_co_rol'  => '1',
        ]);


        DB::table('permisos')->insert([
            'fk_menus_permisos_co_menu' => '1',
            'fk_roles_permisos_co_rol'  => '2',
        ]);

        DB::table('permisos')->insert([
            'fk_menus_permisos_co_menu' => '2',
            'fk_roles_permisos_co_rol'  => '2',
        ]);

    
        DB::table('permisos')->insert([
            'fk_menus_permisos_co_menu' => '1',
            'fk_roles_permisos_co_rol'  => '3',
        ]);


        DB::table('empresas')->insert([
            'nb_nombre'    => 'Desarrolador',
            'nb_rif'       => 'J-00000000',
            'nb_direccion' => 'San Cristobal',
        ]);

        DB::table('empresas')->insert([
            'nb_nombre'    => 'Empresa 1',
            'nb_rif'       => 'J-123456789',
            'nb_direccion' => 'San Cristobal',
        ]);

        DB::table('empresas')->insert([
            'nb_nombre'    => 'Empresa 2',
            'nb_rif'       => 'J-987654321',
            'nb_direccion' => 'San Cristobal',
        ]);

        DB::table('usuarios')->insert([
            'nb_email'         => 'admin@gmail.com',
            'nb_username'      => 'admin',
            'password'         => bcrypt('123456'),
            'nb_nombre'        => 'Administrador',
            'nb_apellido'      => 'Sistema',
            'nb_RUC'           => 'V-00000000',
            'fk_roles_usuarios_co_rol' => '1',
            'fk_empresas_usuarios_co_empresa' => '1',
        ]);

        DB::table('usuarios')->insert([
            'nb_email'         => 'user1@gmail.com',
            'nb_username'      => 'user1',
            'password'         => bcrypt('123456'),
            'nb_nombre'        => 'User 1',
            'nb_apellido'      => 'Prueba',
            'nb_RUC'           => 'V-21234567',
            'fk_roles_usuarios_co_rol' => '2',
            'fk_empresas_usuarios_co_empresa' => '2',
        ]);

        DB::table('usuarios')->insert([
            'nb_email'         => 'user2@gmail.com',
            'nb_username'      => 'user2',
            'password'         => bcrypt('123456'),
            'nb_nombre'        => 'User 2',
            'nb_apellido'      => 'Prueba',
            'nb_RUC'           => 'V-11234567',
            'fk_roles_usuarios_co_rol' => '3',
            'fk_empresas_usuarios_co_empresa' => '3',
        ]);

        DB::table('productos')->insert([
            'ra_foto'           => 'p1.png',
            'nb_nombre'         => 'Prueba',
            'nu_precio'         => '1000000',
            'nu_descuento'      => '5',
            'nu_cantidad'       => '10',
            'nu_descuentoGrupo' => '10',
            'nu_cantidadGrupo'  => '20',
            'fk_empresas_productos_empresa' => '2',
        ]);

        DB::table('productos')->insert([
            'ra_foto'           => 'p2.png',
            'nb_nombre'         => 'Otro',
            'nu_precio'         => '2000000',
            'nu_descuento'      => '5',
            'nu_cantidad'       => '5',
            'nu_descuentoGrupo' => '10',
            'nu_cantidadGrupo'  => '10',
            'fk_empresas_productos_empresa' => '2',
        ]);
    }
}
