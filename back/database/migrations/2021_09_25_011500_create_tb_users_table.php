<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ユーザマスタ
class CreateTbUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id')->unique(); //社員ID
            $table->string('login_id'); //ログインID
            $table->string('password'); //パスワード
            $table->string('employee_name'); //社員氏名
            $table->string('user_avata')->nullable(); //画像ファイル
            $table->date('hire_date'); //入社日
            $table->date('leave_date')->nullable(); //退社日
            $table->string('grade'); //等級
            $table->string('affiliation'); //所属サークル
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
        Schema::dropIfExists('tb_users');
    }
}
