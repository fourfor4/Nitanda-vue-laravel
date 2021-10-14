<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//プロジェクトテーブル
class CreateTbProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_project', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_name'); //プロジェクト名
            $table->integer('department_id'); //部署ID tb_department ID
            $table->integer('system_id'); //システムID system_master ID
            $table->enum('classification', ['new', 'replace', 'single']); //分類（新規、リプレイス、単発）
            $table->integer('account_id'); //取引先ID（取引先マスタのID） account_master ID
            $table->date('start_date'); //開始日
            $table->date('end_date'); //終了日
            $table->string('note')->nullable(); // 備考
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
        Schema::dropIfExists('tb_project');
    }
}
