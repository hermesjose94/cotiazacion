<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'menus';

    /**
     * Run the migrations.
     * @table menus
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('pk_menu')->comment('id de la tabla menus');
            $table->string('nb_name', 60)->comment('nombre que se mostrara en el menu');
            $table->string('nb_icon', 50)->default('fa fa-circle-o')->comment('icono del menu');
            $table->string('nb_slug', 150)->comment('ruta de larevel que a la que se redijeel menu');
            $table->integer('nu_parent')->default('0')->comment('referencia al menu padre si tiene en caso de no tener se coloca 0');
            $table->integer('nu_order')->comment('orden en el que aparece la opcion en el menu ');
            $table->boolean('lo_enabled')->comment('para manejar si la opcion es visible o no');
            $table->nullableTimestamps();
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
