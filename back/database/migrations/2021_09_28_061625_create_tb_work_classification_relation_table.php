<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//作業分類リレーション
class CreateTbWorkClassificationRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_work_classification_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('work_id'); //作業ID tb_work ID
            $table->integer('classification_id'); //作業分類ID work_classification_master ID
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
        Schema::dropIfExists('tb_work_classification_relation');
    }
}
