<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//部署目標
class CreateDepartmentGoalMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_goal_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('department_id'); //部署ID tb_department ID
            $table->string('goal'); //目標（備考）
            $table->date('start_date'); //開始日
            $table->date('end_date'); //終了日
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
        Schema::dropIfExists('department_goal_master');
    }
}
