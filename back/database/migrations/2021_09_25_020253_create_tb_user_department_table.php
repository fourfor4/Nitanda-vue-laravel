<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//ユーザ部署リレーション
class CreateTbUserDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user_department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id'); //ユーザID tb_users 'id'
            $table->integer('department_id'); //部署ID tb_departments 'id'
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
        Schema::dropIfExists('tb_user_department');
    }
}
