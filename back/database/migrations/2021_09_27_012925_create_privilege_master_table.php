<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


//権限マスタ
class CreatePrivilegeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id'); // ロールID（ロールマスタのID） tb_role ID
            $table->integer('table_id'); //テーブルID（テーブルマスタのID）※テーブル毎の権限にするか、メニュー毎にするか要検討 table_master ID
            $table->string('auth'); // 権限区分
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
        Schema::dropIfExists('privilege_master');
    }
}
