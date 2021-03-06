<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\HasRole;

class User extends \Eloquent implements UserInterface, RemindableInterface
{
public static $rules = array(
    'email'=>'required|email|unique:users',
    'username'=>'required|min:2|unique:users',
    'password'=>'required|alpha_num|between:6,30|confirmed',
    'password_confirmation'=>'required|alpha_num|between:6,30',
);
    // Using: $user->present()->anyMethodYourWant()
    use PresentableTrait;
    public $presenter = 'Phphub\Presenters\UserPresenter';

    // Enable hasRole( $name ), can( $permission ),
    // and ability($roles, $permissions, $options)
    use HasRole;

    // Enable soft delete--定义软删除
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    protected $table      = 'users';
    protected $hidden     = ['id'];
    //黑名单 下的列名 不允许批量更改。
    protected $guarded    = ['id', 'notifications', 'is_banned'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($topic) {
            SiteStatus::newUser();
        });
    }
    //收藏的文章
    public function favoriteTopics()
    {
        return $this->belongsToMany('Topic', 'favorites')->withTimestamps();
    }
    //关注文章
    public function attentTopics()
    {
        return $this->belongsToMany('Topic', 'attentions')->withTimestamps();
    }

    //文章
    public function topics()
    {
        return $this->hasMany('Topic');
    }
    //回复
    public function replies()
    {
        return $this->hasMany('Reply');
    }
    //通知
    public function notifications()
    {
        return $this->hasMany('Notification')->recent()->with('topic', 'fromUser')->paginate(20);
    }
    //该用户关注的数量
    public function fanssystem_from(){
        return $this->hasMany('Fanssystem','from_user_id','id');
    }
    //该用户被关注的数量
    public function fanssystem_to(){
        return $this->hasMany('Fanssystem','to_user_id','id');
    }
    //简历
    public function resume(){
        return $this->hasMany('Resume');
    }
    //项目经历
    public function projects()
    {
        return $this->hasMany('Userproject','user_id','id');
    }
    //项目点赞
    public function projectvote(){
        return $this->hasMany('ProjectVote','user_id','id');
    }
    //通过gihubid 获取
    public function getByGithubId($id)
    {
        return $this->where('github_id', '=', $id)->first();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * ----------------------------------------
     * UserInterface
     * ----------------------------------------
     */

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * ----------------------------------------
     * RemindableInterface
     * ----------------------------------------
     */

    public function getReminderEmail()
    {
        return $this->email;
    }
    public function getReminderUserName(){
        return $this->username;
    }
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Cache github avatar to local
     * @author Xuan
     */
    public function cacheAvatar()
    {
        //Download Image
        $guzzle = new GuzzleHttp\Client();
        $response = $guzzle->get($this->image_url);

        //Get ext
        $content_type = explode('/', $response->getHeader('Content-Type'));
        $ext = array_pop($content_type);

        $avatar_name = $this->id . '_' . time() . '.' . $ext;
        $save_path = public_path('uploads/avatars/') . $avatar_name;

        //Save File
        $content = $response->getBody()->getContents();
        file_put_contents($save_path, $content);

        //Delete old file
        if ($this->avatar) {
            @unlink(public_path('uploads/avatars/') . $this->avatar);
        }

        //Save to database
        $this->avatar = $avatar_name;
        $this->save();
    }
    public function getAuthSalt()
    {
        return $this->salt;
    }
    //获取该用户所有文章总共的攒
    public function getTopicsups(){
        $votes= DB::table('topics')->where('user_id','=',$this->id)->lists('vote_count');
        $votesCount=0;
        foreach($votes as $vote)
        {
            $votesCount+=$vote;
        }
        return $votesCount;
    }
    //获取该用户关注的用户数量
    public function getFocusCount(){

    }
    //获取该用户被关注的数量
    //获取该用户的职位
    public function GetSkillByUserid(){
        $resume=Resume::find($this->id);
        if(is_null($resume)){
            return "用户尚未添加";
        }
        $skill=$resume->Skill()->first();
        return $skill->skill;
    }
    //找到所有关注我的用户
    public function FindMyFans(){
        $users=$this->fanssystem_to();
        return $users;
    }
}
