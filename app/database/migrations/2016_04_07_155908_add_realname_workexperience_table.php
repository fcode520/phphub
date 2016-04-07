<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRealnameWorkexperienceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Resume', function(Blueprint $table)
		{
			$table->string('real_name')->nullable()->default("");
			$table->integer('work_experience')->nullable()->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Resume', function(Blueprint $table)
		{
			$table->dropColumn("real_name");
			$table->dropColumn("work_experience");
		});
	}

}
