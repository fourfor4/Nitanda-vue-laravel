<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag_name');
            $table->string('category');
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
        Schema::dropIfExists('tag_masters');
    }
}
