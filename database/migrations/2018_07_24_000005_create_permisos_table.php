<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'permisos';

    /**
     * Run the migrations.
     * @table permisos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('pk_permiso')->comment('codigo identificador del permiso');
            $table->unsignedInteger('fk_menus_permisos_co_menu')->comment('id del menu');
            $table->unsignedInteger('fk_roles_permisos_co_rol')->nullable()->comment('id del rol si el permiso es para rol de lo contrario va null');
            $table->unsignedInteger('fk_ususarios_permisos_co_usuario')->nullable()->comment('id del usuario si el permiso es por usuario de lo contrario va null');

            $table->index(["fk_roles_permisos_co_rol"], 'fk_roles_permisos_co_rol');

            $table->index(["fk_menus_permisos_co_menu"], 'fk_menus_permisos_co_menu');

            $table->index(["fk_ususarios_permisos_co_usuario"], 'fk_ususarios_permisos_co_usuario');
            $table->nullableTimestamps();


            $table->foreign('fk_menus_permisos_co_menu', 'fk_menus_permisos_co_menu')
                ->references('pk_menu')->on('menus')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('fk_roles_permisos_co_rol', 'fk_roles_permisos_co_rol')
                ->references('pk_rol')->on('roles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('fk_ususarios_permisos_co_usuario', 'fk_ususarios_permisos_co_usuario')
                ->references('pk_usuario')->on('usuarios')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
