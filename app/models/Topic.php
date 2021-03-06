<?php

use Laracasts\Presenter\PresentableTrait;
use Naux\AutoCorrect;

class Topic extends \Eloquent
{
    // manually maintian
    //禁止自动更新 时间戳
    public $timestamps = false;
    //
    use PresentableTrait;
    protected $presenter = 'Phphub\Presenters\TopicPresenter';
    //软删除
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    // Don't forget to fill this array
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'body_original',
        'user_id',
        'node_id',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($topic) {
            SiteStatus::newTopic();
        });
    }

    public function votes()
    {
        return $this->morphMany('Vote', 'votable');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany('User', 'favorites');
    }

    public function attentedBy()
    {
        return $this->belongsToMany('User', 'attentions');
    }

    public function node()
    {
        return $this->belongsTo('Node');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function lastReplyUser()
    {
        return $this->belongsTo('User', 'last_reply_user_id');
    }

    public function replies()
    {
        return $this->hasMany('Reply');
    }

    public function appends()
    {
        return $this->hasMany('Append');
    }

    public function getWikiList()
    {
        return $this->where('is_wiki', '=', true)->orderBy('created_at', 'desc')->get();
    }

    public function generateLastReplyUserInfo()
    {
        $lastReply = $this->replies()->recent()->first();

        $this->last_reply_user_id = $lastReply ? $lastReply->user_id : 0;
        $this->save();
    }

    public function getRepliesWithLimit($limit = 30)
    {
        // 默认显示最新的回复
        if (is_null(\Input::get(\Paginator::getPageName()))) {
            $latest_page = ceil($this->reply_count / $limit);
            \Paginator::setCurrentPage($latest_page ?: 1);
        }

        return $this->replies()
                    ->orderBy('created_at', 'asc')
                    ->with('user')
                    ->paginate($limit);
    }

    public function getTopicsWithFilter($filter, $limit = 20)
    {
        return $this->applyFilter($filter)
                    ->with('user', 'node', 'lastReplyUser')
                    ->paginate($limit);
    }

    public function getNodeTopicsWithFilter($filter, $node_id, $limit = 20)
    {
        return $this->applyFilter($filter == 'default' ? 'node' : $filter)
                    ->where('node_id', '=', $node_id)
                    ->with('user', 'node', 'lastReplyUser')
                    ->paginate($limit);
    }

    public function applyFilter($filter)
    {
        switch ($filter) {
            //没有回复
            case 'noreply':
                return $this->orderBy('reply_count', 'asc')->recent();
                break;
            //投票-点赞
            case 'vote':
                return $this->orderBy('vote_count', 'desc')->recent();
                break;
            //推荐
            case 'excellent':
                return $this->excellent()->recent();
                break;
            //最新
            case 'recent':
                return $this->recent();
                break;
            //节点
            case 'node':
                return $this->recentReply();
                break;
//            默认
            default:
                return $this->pinAndRecentReply();
                break;
        }
    }

    /**
     * 边栏同一节点下的话题列表
     */
    public function getSameNodeTopics($limit = 8)
    {
        return Topic::where('node_id', '=', $this->node_id)
                        ->recent()
                        ->take($limit)
                        ->remember(10)
                        ->get();
    }
    public static  function getNodeTopics($nodeid,$limit=5){

        return Topic::select('id','title','user_id','created_at')->where('node_id', '=', $nodeid)
            ->recent()
            ->take($limit)
            ->remember(10)
            ->orderBy('created_at', 'desc')
            ->get();

    }
    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id)->with('node');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePinAndRecentReply($query)
    {
//        return $query->whereRaw("(`created_at` > '".Carbon::today()->subMonth()->toDateString()."' or (`order` > 0) )")
//                     ->orderBy('order', 'desc')
//                     ->orderBy('updated_at', 'desc');
        return $query->whereRaw("(`created_at` > '".Carbon::today()->subYear()->toDateString()."' or (`order` > 0) )")
                     ->orderBy('order', 'desc')
                     ->orderBy('updated_at', 'desc');
    }

    public function scopeRecentReply($query)
    {
        return $query->orderBy('order', 'desc')
                     ->orderBy('updated_at', 'desc');
    }

    public function scopeExcellent($query)
    {
        return $query->where('is_excellent', '=', true);
    }
    public static  function scopeExcellentEx($limit)
    {
        return Topic::select('id','title','user_id','created_at')->where('is_excellent', '=', true)->take($limit)
            ->remember(10)
            ->get();
    }


    public static function makeExcerpt($body)
    {
        $html = $body;
        $excerpt = trim(preg_replace('/\s\s+/', ' ', strip_tags($html)));
        return str_limit($excerpt, 200);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = (new AutoCorrect)->convert($value);
    }
    public static function getSideInfos($limit){
        $sideInfos=array();
        $sideInfos[0]=Topic::scopeExcellentEx($limit);
        $sideInfos[1]=Topic::getNodeTopics(6,$limit);
        $sideInfos[2]=Topic::getNodeTopics(5,$limit);
        return $sideInfos;
    }
}
