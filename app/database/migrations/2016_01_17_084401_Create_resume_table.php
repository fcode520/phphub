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
			$table->integer('sex')->default(0);//0 �� 1 Ů 2����
			$table->integer('profession_id');
			$table->integer('remote_status')->default(0);//0 ��ְԶ�� 1 ȫְ 2��Զ��
			$table->integer('skill_id');//�����б�  c++ ios
			$table->string('qq');
			$table->string('position');
			$table->string('summary');//���˼��
			$table->string('skill_experience');//��������
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
