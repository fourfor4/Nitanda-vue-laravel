<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//個人情報テーブル
class CreateTbPersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_personal_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id'); //ユーザID tb_users ID
            $table->integer('table_id'); //テーブルID table_master ID
            $table->integer('link_id'); //連携ID（テーブルマスタに準拠したテーブルのID）
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
        Schema::dropIfExists('tb_personal_info');
    }
}
