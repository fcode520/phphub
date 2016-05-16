<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('NavigationItems', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('LinkCategoryID')->nullable();
            $table->string('LinkName');
            $table->string('LinkUrl');
            $table->string('LinkDescription');
            $table->string('Logo');
            $table->boolean('priority');//是否优先
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
        Schema::drop('NavigationItems');
	}

}
