<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Resume', function (Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('head_img')->nullable();
			$table->string('email')->nullable()->unique();;
			$table->integer('sex')->default(0);//0 男 1 女 2保密
			$table->integer('profession_id');
			$table->integer('remote_status')->default(0);//0 兼职远程 1 全职 2非远程
			$table->integer('skill_id');//技能列表  c++ ios
			$table->string('qq');
			$table->string('position');
			$table->string('summary');//个人简介
			$table->string('skill_experience');//技术经验
			$table->softDeletes();
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
		Schema::drop('appends');
	}

}
