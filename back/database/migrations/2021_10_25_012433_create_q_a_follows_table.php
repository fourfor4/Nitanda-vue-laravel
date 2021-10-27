<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQAFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('follow_id'); //フォロー先ID tb_question or tb_answer ID
            $table->integer('user_id'); //ユーザID tb_users ID
            $table->enum('category', ['1', '2']); //区分（1:質問/2:回答）
            $table->integer('score'); //スコア
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
        Schema::dropIfExists('q_a_follows');
    }
}
