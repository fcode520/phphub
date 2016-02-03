<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//ְҵ���ܱ�

class CreateSkillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skill', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('skill');

            $this->initData();
		});
	}

    public function initData()
    {
        $skills = [
            ['sill' => 'C++'],
            ['sill' => 'java'],
            ['sill' => 'php'],
            ['sill' => 'c#/.net'],
            ['sill' => 'python'],
            ['sill' => 'delphi'],
            ['sill' => 'perl'],
            ['sill' => 'ruby'],
            ['sill' => 'node.js'],
            ['sill' => 'go'],
            ['sill' => 'Android'],
            ['sill' => 'IOS'],
            ['sill' => 'javascript'],
            ['sill' => 'u3d'],
            ['sill' => 'cocos2d-x'],
            ['sill' => '前端开发'],
            ['sill' => '后端开发'],
            ['sill' => '数据挖掘'],
            ['sill' => '自然语言处理'],
            ['sill' => '算法'],
            ['sill' => '移动端开发'],
            ['sill' => '嵌入式开发'],
            ['sill' => '测试'],
            ['sill' => '运维'],
            ['sill' => '病毒分析'],
            ['sill' => 'web 安全'],
            ['sill' => '数据库开发'],
            ['sill' => '项目管理'],
            ['sill' => 'app设计'],
            ['sill' => '交互设计'],
            ['sill' => '数据分析'],
            ['sill' => '运营'],
        ];
        DB::table('skill')->insert($skills);
    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('skill');
	}

}
