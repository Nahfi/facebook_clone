<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('users', function (Blueprint $table) {
           $table->after("name",function( Blueprint $table){




            $table->renameColumn("name","fname");
            $table->string("lname");
      
            $table->boolean("sex");
            $table->string("photo")->default("avatar.jpg");
            $table->date("birthday")->default("2022-01-02");


           });
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
