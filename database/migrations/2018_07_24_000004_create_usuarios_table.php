<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'usuarios';

    /**
     * Run the migrations.
     * @table usuarios
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('pk_usuario')->comment('clave idenficador usuario');
            $table->string('nb_email', 100)->comment('correo electronico del usuario');
            $table->string('nb_username', 100)->comment('nombre de usuario para el login');
            $table->string('ra_avatarAvatar', 128)->default('avatar.png')->comment('avatar del usuario guardando solo el nombre de la imagen');
            $table->string('password')->comment('clave del usuario se guarda un has de la misma');
            $table->string('nb_nombre', 50)->comment('nombre del usuario');
            $table->string('nb_apellido', 50)->comment('apellido del usuario');
            $table->string('nb_RUC', 45)->nullable();
            $table->boolean('lo_estado')->default('0')->comment('????');
            $table->rememberToken();
            $table->unsignedInteger('fk_roles_usuarios_co_rol')->comment('rol del usuario');
            $table->integer('fk_empresas_usuarios_co_empresa');

            $table->index(["fk_empresas_usuarios_co_empresa"], 'fk_usuarios_empresas1_idx');

            $table->index(["fk_roles_usuarios_co_rol"], 'fk_roles_usuarios_co_rol');
            $table->nullableTimestamps();


            $table->foreign('fk_roles_usuarios_co_rol', 'fk_roles_usuarios_co_rol')
                ->references('pk_rol')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('fk_empresas_usuarios_co_empresa', 'fk_usuarios_empresas1_idx')
                ->references('pk_empresa')->on('empresas')
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
