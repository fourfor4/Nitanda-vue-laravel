<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//プロジェクトファイルテーブル
class CreateTbProjectFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_project_file', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->nullable(); //プロジェクトID（プロジェクトテーブルのID）※空白可　tb_project ID
            $table->string('file'); //ファイル（添付ファイルの保存先
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
        Schema::dropIfExists('tb_project_file');
    }
}
