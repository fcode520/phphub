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

		});
        $this->initData();

	}

    public function initData()
    {
        $skills = [
            ['skill' => 'C++'],
            ['skill' => 'java'],
            ['skill' => 'php'],
            ['skill' => 'c#/.net'],
            ['skill' => 'python'],
            ['skill' => 'delphi'],
            ['skill' => 'perl'],
            ['skill' => 'ruby'],
            ['skill' => 'node.js'],
            ['skill' => 'go'],
            ['skill' => 'Android'],
            ['skill' => 'IOS'],
            ['skill' => 'javascript'],
            ['skill' => 'u3d'],
            ['skill' => 'cocos2d-x'],
            ['skill' => '前端开发'],
            ['skill' => '后端开发'],
            ['skill' => '数据挖掘'],
            ['skill' => '自然语言处理'],
            ['skill' => '算法'],
            ['skill' => '移动端开发'],
            ['skill' => '嵌入式开发'],
            ['skill' => '测试'],
            ['skill' => '运维'],
            ['skill' => '病毒分析'],
            ['skill' => 'web 安全'],
            ['skill' => '数据库开发'],
            ['skill' => '项目管理'],
            ['skill' => 'app设计'],
            ['skill' => '交互设计'],
            ['skill' => '数据分析'],
            ['skill' => '运营'],
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
