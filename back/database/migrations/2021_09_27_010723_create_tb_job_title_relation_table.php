<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//ユーザ役職リレーションc
class CreateTbJobTitleRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_job_title_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id'); //ユーザID tb_users ID
            $table->integer('job_title_id'); //役職ID tb_job_title ID
            $table->integer('role_id'); //ロールID tb_role ID
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
        Schema::dropIfExists('tb_job_title_relation');
    }
}
