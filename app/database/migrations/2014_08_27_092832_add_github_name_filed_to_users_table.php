<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGithubNameFiledToUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_git', function (Blueprint $table) {
            $table->string('github_name')->nullable()->index();
            $table->string('real_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_git', function (Blueprint $table) {
            $table->dropColumn('github_name');
            $table->dropColumn('real_name');
        });
    }
}
