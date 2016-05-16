<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('NavigationCategory', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('LinkCategoryName')->unique()->nullable();
            $table->string('NickName')->unique()->nullable();
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
        Schema::drop('NavigationCategory');
	}

}
