<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//役職マスタ
class CreateTbJobTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_job_title', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');//役職名
            $table->string('category'); //使用区分（表示区分）
            $table->integer('creator_id'); //作成者（ユーザID)
            $table->integer('updater_id')->nullable(); //更新者（ユーザID）
            $table->enum('del_flag', ['0', '1']); //削除区分
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
        Schema::dropIfExists('tb_job_title');
    }
}
