<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id')->unique(); //社員ID
            $table->string('login_id')->unique(); //ログインID
            $table->string('password'); //パスワード
            $table->string('employee_name'); //社員氏名
            $table->string('avatar_url')->nullable(); //画像ファイル
            $table->string('hire_date')->nullable(); //入社日
            $table->string('leave_date')->nullable(); //退社日
            $table->string('grade')->nullable(); //等級
            $table->string('affiliation')->nullable(); //所属サークル
            $table->string('mygoal')->nullable(); //所属サークル
            $table->string('note')->nullable(); //備考
            $table->integer('creator_id')->nullable(); //作成者（ユーザID)
            $table->integer('updater_id')->nullable(); //更新者（ユーザID）
            $table->integer('department_id');
            $table->integer('role_id'); 
            $table->enum('del_flag', ['0', '1'])->default(0); //削除区分
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
        Schema::dropIfExists('users');
    }
}
