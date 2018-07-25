<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'productos';

    /**
     * Run the migrations.
     * @table productos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('pk_producto');
            $table->string('ra_foto', 45)->default('foto.png');
            $table->string('nb_nombre', 45);
            $table->float('nu_precio');
            $table->float('nu_descuento');
            $table->integer('nu_cantidad');
            $table->float('nu_descuentoGrupo');
            $table->integer('nu_cantidadGrupo');
            $table->integer('fk_empresas_productos_empresa');

            $table->index(["fk_empresas_productos_empresa"], 'fk_productos_empresas1_idx');
            $table->nullableTimestamps();


            $table->foreign('fk_empresas_productos_empresa', 'fk_productos_empresas1_idx')
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
