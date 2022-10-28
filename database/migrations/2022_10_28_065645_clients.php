<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        schema::create("clients",function(Blueprint $table){
            $table->string("name",32);
            $table->string("email",32);
            $table->string("phone",15);
            $table->string("password",35);
            $table->increments("id");
            $table->string("img");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
