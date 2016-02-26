<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
        id	                int(11)	        NO	PRI		auto_increment
        url	                char(255)	    NO
        titulo	            char(255)	    YES
        descripcion	        text	        YES
        status	            tinyint(1)	    NO		0
        fecha_publicacion	datetime	    NO			
        created_at	        datetime	    YES
        updated_at	        datetime	    YES
        imagen	            varchar(255)	YES
        source_id	        int(15)	        YES
        longitud	        decimal(12,8)	YES
        latitud	            decimal(12,8)	YES
    */


    public function up()
    {
        Schema::create('noticia', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('noticia');
    }
}
