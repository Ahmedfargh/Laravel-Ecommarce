<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("Categorys",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->string("name",32);
            $table->integer("parent_cat");
            //$table->foreign("parent_cat")->references("id")->on("Categorys")->onDelete("cascade")->onUpdate("cascade")->change();
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
