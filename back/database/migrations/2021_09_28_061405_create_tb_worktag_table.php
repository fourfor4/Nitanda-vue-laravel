<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//タグリレーション
class CreateTbWorktagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_worktag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('work_id'); //作業ID tb_work ID
            $table->integer('tag_id'); //タグID tb_tag ID
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
        Schema::dropIfExists('tb_worktag');
    }
}
