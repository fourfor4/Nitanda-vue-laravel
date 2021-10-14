<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//質問テーブル
class CreateTbQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content'); //質問内容
            $table->string('attachment'); //添付ファイル attachment url
            $table->integer('post_id'); //質問者ID（ユーザID）tb_users ID
            $table->string('anonymous'); //匿名区分
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
        Schema::dropIfExists('tb_question');
    }
}
