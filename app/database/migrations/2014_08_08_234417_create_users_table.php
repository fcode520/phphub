<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
//			$table->integer('user_id')->index();
            $table->string('email',100)->unique();
            $table->string('username')->unique();
            $table->string('password',64);
            $table->boolean('is_banned')->default(false)->index();
            $table->integer('topic_count')->default(0)->index();
            $table->integer('reply_count')->default(0)->index();
            $table->integer('notification_count')->default(0);
            $table->string('avatar')->default("def_avatars.png");
            $table->text('login_token',255)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
//            $table->increments('id')->unsigned();
//            $table->integer('github_id')->index();
//            $table->string('github_url');
//            $table->string('email')->nullable()->index();
//            $table->string('name')->nullable()->index();
//            $table->string('remember_token')->nullable();
//            $table->boolean('is_banned')->default(false)->index();
//            $table->string('image_url')->nullable();
//            $table->integer('topic_count')->default(0)->index();
//            $table->integer('reply_count')->default(0)->index();
//            $table->string('city')->nullable();
//            $table->string('company')->nullable();
//            $table->string('twitter_account')->nullable();
//            $table->string('personal_website')->nullable();
//            $table->string('signature')->nullable();
//            $table->string('introduction')->nullable();
//            $table->softDeletes();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
