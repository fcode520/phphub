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
            ['skill' => 'C++工程师'],
            ['skill' => 'java工程师'],
            ['skill' => 'php工程师'],
            ['skill' => 'c#/.net工程师'],
            ['skill' => 'python工程师'],
            ['skill' => 'delphi工程师'],
            ['skill' => 'perl工程师'],
            ['skill' => 'ruby工程师'],
            ['skill' => 'node.js工程师'],
            ['skill' => 'go工程师'],
            ['skill' => 'Android工程师'],
            ['skill' => 'IOS工程师'],
            ['skill' => 'javascript工程师'],
            ['skill' => 'u3d工程师'],
            ['skill' => 'cocos2d-x工程师'],
            ['skill' => '前端开发工程师'],
            ['skill' => '后端开发工程师'],
            ['skill' => '数据挖掘工程师'],
            ['skill' => '应用开发工程师'],
            ['skill' => '自然语言处理工程师'],
            ['skill' => '算法工程师'],
            ['skill' => '移动端开发工程师'],
            ['skill' => '嵌入式开发工程师'],
            ['skill' => '测试工程师'],
            ['skill' => '运维工程师'],
            ['skill' => '病毒分析工程师'],
            ['skill' => 'web 安全工程师'],
            ['skill' => '数据库开发工程师'],
            ['skill' => '产品经理'],
            ['skill' => '设计师'],
            ['skill' => 'app设计师'],
            ['skill' => '交互设计师'],
            ['skill' => '数据分析师'],
            ['skill' => '创始人'],
            ['skill' => '合伙人'],
            ['skill' => '运营'],
            ['skill' => '市场'],
            ['skill' => 'HR'],
            ['skill' => 'CTO'],
            ['skill' => 'CEO'],
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
