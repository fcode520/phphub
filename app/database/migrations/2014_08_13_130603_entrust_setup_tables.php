<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the roles table
        Schema::create('roles', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Creates the assigned_roles (Many-to-Many relation) table
        Schema::create('assigned_roles', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Creates the permissions table
        Schema::create('permissions', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('permission_role', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions'); // assumes a users table
            $table->foreign('role_id')->references('id')->on('roles');
        });

        $this->setupFoundorAndBaseRolsPermission();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::table('assigned_roles', function (Blueprint $table) {
            $table->dropForeign('assigned_roles_user_id_foreign');
            $table->dropForeign('assigned_roles_role_id_foreign');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });

        Schema::drop('assigned_roles');
        Schema::drop('permission_role');
        Schema::drop('roles');
        Schema::drop('permissions');
    }
    /**
     * 生成密码种子
     *
     * @param  integer
     * @return string
     */
    function fetch_salt($length = 4)
    {
        $salt='';
        for ($i = 0; $i < $length; $i++)
        {
            $salt .= chr(rand(97, 122));
        }

        return $salt;
    }
    /**
     * 根据 salt 混淆密码
     *
     * @param  string
     * @param  string
     * @return string
     */
    function compile_password($password, $salt)
    {
        $password = md5(md5($password) . $salt);

        return $password;
    }
    public function setupFoundorAndBaseRolsPermission()
    {
        // Create Roles
        $founder = new Role;
        $founder->name = 'Founder';
        $founder->save();

        $admin = new Role;
        $admin->name = 'Admin';
        $admin->save();
        $salt=$this->fetch_salt(4);
        // Create User
        $user = User::create([
                'id' => 1,
                'username' => 'zhanglei',
                'password' => $this->compile_password('zhanglei',$salt),
                'email'=>'fcode520@gmail.com',
                'salt'=>$salt

            ]);

        // Attach Roles to user
        $user->roles()->attach($founder->id);

        // Create Permissions
        $manageTopics = new Permission;
        $manageTopics->name = 'manage_topics';
        $manageTopics->display_name = 'Manage Topics';
        $manageTopics->save();

        $manageUsers = new Permission;
        $manageUsers->name = 'manage_users';
        $manageUsers->display_name = 'Manage Users';
        $manageUsers->save();

        // Assign Permission to Role
        $founder->perms()->sync([$manageTopics->id, $manageUsers->id]);
        $admin->perms()->sync([$manageTopics->id]);
    }
}
