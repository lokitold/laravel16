<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_id')->unsigned();
            $table->decimal('longitud', 12, 8)->nullable();
            $table->decimal('latitud', 12, 8)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('noticia_id')->references('id')->on('noticia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
    }
}
