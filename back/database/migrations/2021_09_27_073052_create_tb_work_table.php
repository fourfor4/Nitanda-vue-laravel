<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//作業テーブル
class CreateTbWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content'); //作業内容
            $table->date('start_date'); //作業開始日
            $table->date('end_date'); //作業終了日
            $table->integer('user_id'); //作業者ID（ユーザマスタのID）tb_users ID
            $table->enum('status', ['not_start','working','finished']); //状態区分（未着手/作業中/完了）※要検討　タスク管理に繋がる
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
        Schema::dropIfExists('tb_work');
    }
}
