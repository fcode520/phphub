<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlogToResume extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Resume', function(Blueprint $table)
		{
			$table->string('blog')->nullable()->default("");
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
			$table->dropColumn("blog");
		});
	}

}
