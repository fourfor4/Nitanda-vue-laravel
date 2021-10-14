<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//プロジェクトメンバーテーブル
class CreateTbProjectMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_project_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->nullable(); // プロジェクトID tb_project ID 
            $table->string('classification'); // プロジェクト区分（営業担当、PM等）  
            $table->string('staff_id'); //担当者ID（ユーザマスタのID） tb_users ID
            $table->string('note'); //備考
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
        Schema::dropIfExists('tb_project_member');
    }
}
