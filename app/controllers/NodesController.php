<?php
//�ڵ�/���� ������
class NodesController extends \BaseController
{

    protected $topic;

    public function __construct(Topic $topic)
    {
        parent::__construct();
        
        $this->topic = $topic;
    }

    public function show($id)
    {
        $node = Node::findOrFail($id);
        $filter = $this->topic->present()->getTopicFilter();
        $topics = $this->topic->getNodeTopicsWithFilter($filter, $id);
        $sideInfos=$this->topic->getSideInfos(5);
        return View::make('topics.index', compact('sideInfos','topics', 'node'));
    }
}
