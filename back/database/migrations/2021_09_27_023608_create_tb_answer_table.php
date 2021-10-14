<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//回答テーブル
class CreateTbAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('question_id'); //質問ID
            $table->integer('content'); //回答内容
            $table->integer('rep_id'); //回答者ID（ユーザID） tb_users ID
            $table->integer('attachment'); //添付ファイル
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
        Schema::dropIfExists('tb_answer');
    }
}
