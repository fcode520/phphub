<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//profession
//����ְҵ��
class CreateProfessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profession', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('profession')->default('');
		});
        $this->iniData();
	}

    public function  iniData()
    {
        $profession = [
            ['profession' => '全职远程职业者'],
            ['profession' => '兼职远程工作者'],
            ['profession' => '非远程工作者'],
        ];
        DB::table('profession')->insert($profession);
    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profession');
	}

}
