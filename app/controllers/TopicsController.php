<?php

use Phphub\Core\CreatorListener;
use Phphub\Forms\TopicCreationForm;

class TopicsController extends \BaseController implements CreatorListener
{
    protected $topic;

    public function __construct(Topic $topic)
    {
        parent::__construct();

        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->topic = $topic;
    }

    public function index()
    {
        //获取提交时以何种类型获取文章  包括 最新发表 精华主题 最多投票 和无人问津
        $filter = $this->topic->present()->getTopicFilter();

        $topics = $this->topic->getTopicsWithFilter($filter);
        //取所有列表
        $nodes  = Node::allLevelUp();
        //查询结果缓存1440 分钟 获取友情链接
//        $links  = Link::remember(1440)->get();

        return View::make('topics.index', compact('topics', 'nodes'));
    }

    public function create()
    {
        $node = Node::find(Input::get('node_id'));
        $nodes = Node::allLevelUp();

//        return View::make('topics.create_edit', compact('nodes', 'node'));
        return View::make('topics.create_article', compact('nodes', 'node'));
    }

    public function store()
    {
        return App::make('Phphub\Creators\TopicCreator')->create($this, Input::except('_token'));
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        if(is_null($topic))
        {
             return Redirect::to("/")->with('message','所查找的文章不存在');
        }
        if($topic->vote_count<0){
            $topic->vote_count=0;
        }
        $tmp=$topic->body;
        $tmp2=$topic->vote_count;

        $replies = $topic->getRepliesWithLimit(Config::get('phphub.replies_perpage'));
        $node = $topic->node;
        $nodeTopics = $topic->getSameNodeTopics();

        $topic->increment('view_count', 1);

        return View::make('topics.show_article', compact('topic', 'replies', 'nodeTopics', 'node'));
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($topic->user_id);
        $nodes = Node::allLevelUp();
        $node = $topic->node;

        $topic->body = $topic->body_original;

        return View::make('topics.create_article', compact('topic', 'nodes', 'node'));
    }

    public function append($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($topic->user_id);

        $markdown = new Markdown;
        $content = $markdown->convertMarkdownToHtml(Input::get('content'));

        $append = Append::create(['topic_id' => $topic->id, 'content' => $content]);

        App::make('Phphub\Notification\Notifier')->newAppendNotify(Auth::user(), $topic, $append);

        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('topics.show', $topic->id);
    }

    public function update($id)
    {
        $topic = Topic::findOrFail($id);
        $data = Input::only('title', 'body', 'node_id');

        $this->authorOrAdminPermissioinRequire($topic->user_id);

        $markdown = new Markdown;
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);
        $data['excerpt'] = Topic::makeExcerpt($data['body']);

        // Validation
        App::make('Phphub\Forms\TopicCreationForm')->validate($data);

        $topic->update($data);

        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('topics.show', $topic->id);
    }

    /**
     * ----------------------------------------
     * User Topic Vote function
     * ----------------------------------------
     */

    public function upvote($id)
    {
        $topic = Topic::find($id);
        App::make('Phphub\Vote\Voter')->topicUpVote($topic);
        return Redirect::route('topics.show', $topic->id);
    }

    public function downvote($id)
    {
        $topic = Topic::find($id);
        App::make('Phphub\Vote\Voter')->topicDownVote($topic);
        return Redirect::route('topics.show', $topic->id);
    }

    /**
     * ----------------------------------------
     * Admin Topic Management
     * ----------------------------------------
     */

    public function recomend($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($topic->user_id);
        $topic->is_excellent = (!$topic->is_excellent);
        $topic->save();
        Flash::success(lang('Operation succeeded.'));
        Notification::notify('topic_mark_excellent', Auth::user(), $topic->user, $topic);
        return Redirect::route('topics.show', $topic->id);
    }

    public function wiki($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($topic->user_id);
        $topic->is_wiki = (!$topic->is_wiki);
        $topic->save();
        Flash::success(lang('Operation succeeded.'));
        Notification::notify('topic_mark_wiki', Auth::user(), $topic->user, $topic);
        return Redirect::route('topics.show', $topic->id);
    }

    public function pin($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($topic->user_id);
        ($topic->order > 0) ? $topic->decrement('order', 1) : $topic->increment('order', 1);
        return Redirect::route('topics.show', $topic->id);
    }

    public function sink($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($topic->user_id);
        ($topic->order >= 0) ? $topic->decrement('order', 1) : $topic->increment('order', 1);
        return Redirect::route('topics.show', $topic->id);
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);

        $this->authorOrAdminPermissioinRequire($topic->user_id);
        //删除文章
        $topic->delete();
        //该文章相关的通知删除
        Notification::where('user_id','=',$topic->user_id)->where('topic_id','=',$topic->id)->delete();
        //该文章的回复删除
        Reply::where('topic_id','=',$topic->id)->delete();

        Flash::success(lang('Operation succeeded.'));

        $url = Request::getRequestUri();
        if(stripos($url,'account')==false){
            return Redirect::route('topics.index');
        }else{
            return Redirect::route('ac_topices');
        }


    }

    public function uploadImage()
    {
        if ($file = Input::file('file')) {
            $allowed_extensions = ["png", "jpg", "gif"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return ['error' => 'You may only upload png, jpg or gif.'];
            }

            $fileName        = $file->getClientOriginalName();
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = 'uploads/images/' . date("Ym", time()) .'/'.date("d", time()) .'/'. Auth::user()->id;
            $destinationPath = public_path() . '/' . $folderName;
            $safeName        = str_random(10).'.'.$extension;
            $file->move($destinationPath, $safeName);

            // If is not gif file, we will try to reduse the file size
            if ($file->getClientOriginalExtension() != 'gif') {
                // open an image file
                $img = Image::make($destinationPath . '/' . $safeName);
                // prevent possible upsizing
                $img->resize(1440, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                // finally we save the image as a new file
                $img->save();
            }

            $data['filename'] = getUserStaticDomain() . $folderName .'/'. $safeName;

            SiteStatus::newImage();
        } else {
            $data['error'] = 'Error while uploading file';
        }
        return $data;
    }

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */

    public function creatorFailed($errors)
    {
        return Redirect::to('/');
    }

    public function creatorSucceed($topic)
    {
        Flash::success(lang('Operation succeeded.'));

        return Redirect::route('topics.show', array($topic->id));
    }
    //测试一下 发送消息到关注我的人
    public function NotifyTest(){
        if(!Auth::check()){
            return 'login?';
        }
        $user=Auth::user();
        $Myfans=Fanssystem::FindMyFans($user->id);
        $topic = Topic::findOrFail(6);
        App::make('Phphub\Notification\Notifier')->newTopicsNotify($user, $topic);
    return 'ok';
    }
}
