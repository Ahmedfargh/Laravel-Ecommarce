<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        schema::create("admins",function(Blueprint $table){
            $table->string("name",31);
            $table->string("email",32)->unique();
            $table->increments("id",10);
            $table->integer("added_by");
            $table->string("password",35);
            $table->string("img",100);
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
