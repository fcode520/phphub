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
			$table->integer('sex')->nullable()->default(0);//0 �� 1 Ů 2����
			$table->integer('profession_id')->nullable();
			$table->integer('remote_status')->nullable()->default(0);//0 ��ְԶ�� 1 ȫְ 2��Զ��
			$table->integer('skill_id')->nullable();//�����б�  c++ ios
			$table->string('qq')->nullable();
			$table->string('position')->nullable();
			$table->string('summary')->nullable();//���˼��
			$table->string('skill_experience')->nullable();//��������
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
