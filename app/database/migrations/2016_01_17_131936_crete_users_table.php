<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('users', function(Blueprint $table)
//		{
//			$table->increments('id')->unsigned();
////			$table->integer('user_id')->index();
//			$table->string('email',100)->unique();
//			$table->string('username')->unique();
//			$table->string('password',64);
//			$table->boolean('is_banned')->default(false)->index();
//			$table->integer('topic_count')->default(0)->index();
//			$table->integer('reply_count')->default(0)->index();
//			$table->integer('notification_count')->default(0);
//			$table->string('avatar')->default("def_avatars.png");
//			$table->text('login_token',255)->default();
//			$table->rememberToken();
//			$table->softDeletes();
//			$table->timestamps();
//		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::Drop("users");
	}

}
