<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role_name');
            $table->integer('role_level');
            $table->integer('creator_id')->nullable();
            $table->integer('updater_id')->nullable();
            $table->enum('del_flag', ['0', '1']);
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
        Schema::dropIfExists('role_masters');
    }
}
