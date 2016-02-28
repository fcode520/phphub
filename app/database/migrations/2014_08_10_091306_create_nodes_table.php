<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNodesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->nullable()->index();
            $table->smallInteger('parent_node')->nullable()->index();
            $table->text('description')->nullable();
            $table->integer('topic_count')->default(0)->index();
            $table->timestamps();
        });

        $this->initializeNodes();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nodes');
    }

    public function initializeNodes()
    {
        DB::table('nodes')->truncate();
        $node_array = [
            '交流' => [
                '经验' => [
                    'slug' => 'experience',
                    'description' => '分享你在从事远程工作或远程协作过程中所收获的经验与教训，把你遇到的“坑”分享给每一个希望知道的人！',
                ],
                '问答' => [
                    'slug' => 'question',
                    'description' => '有问必答，用心解决每个人的实际中遇到的问题！',
                ],
                '项目' => [
                    'slug' => 'project ',
                    'description' => '你可以发布需要远程工作者参与的任何合法项目！',
                ],
                '工作' => [
                    'slug' => 'job',
                    'description' => '真正的工作，并不是外包，如果你需要真正的远程工作者成为您正式的同事，请在这里发布您的招聘！',
                ],
                '创建远程团队' => [
                    'slug' => 'createteam',
                    'description' => '每个人都应该有自己的团队，在这里我们寻找志同道合多人！',
                ],
                '实战训练' => [
                    'slug' => 'training ',
                    'description' => '真正的技术只有通过实战，才能得以证实！想要提升技能，让我们一起发布实战训练！',
                ],
                '每周必读' => [
                    'slug' => 'requiredread',
                    'description' => '每周一篇，汇聚本周你必须知道的事！',
                ],
                '线上活动' => [
                    'slug' => 'activity',
                    'description' => '在线举办的所有活动，都将发布在这里',
                ],
                '线下聚会' => [
                    'slug' => 'gathering',
                    'description' => '线下聚会，怎能没有你',
                ],
            ],

            '社区' => [
                '公告' => [
                    'slug' => 'announcement',
                    'description' => '',
                ],
                '反馈' => [
                    'slug' => 'feedback',
                    'description' => '对于社区的优化或者 bug report , 可以在此节点下提',
                ],
                '社区开发' => [
                    'slug' => 'community-development',
                    'description' => '构建此社区软件的开发讨论节点',
                ],
            ],
        ];

        $top_nodes = array();
        foreach ($node_array as $key => $value) {
            $top_nodes[] = [
                'name' => $key
            ];
        }
        DB::table('nodes')->insert($top_nodes);

        $nodes = array();
        foreach ($node_array as $key => $value) {
            $top_node = Node::where('name', '=', $key)->first();

            foreach ($value as $snode => $svalue) {
                $nodes[] = [
                    'parent_node' => $top_node->id,
                    'name' => $snode,
                    'slug' => $svalue['slug'],
                    'description' => $svalue['description'],
                ];
            }
        }
        DB::table('nodes')->insert($nodes);
    }
}
