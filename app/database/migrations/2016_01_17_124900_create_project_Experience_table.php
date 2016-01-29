<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectExperienceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_Experience', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('project_name');
			$table->string('role');//���ν�ɫ
			$table->string('start_time');
			$table->string('end_time');
			$table->string('url');
			$table->string('description');//��Ŀ����
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
		Schema::drop('project_Experience');
	}

}
