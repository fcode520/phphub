<?php

use Phphub\Github\GithubUserDataReader;

class UsersController extends \BaseController
{
    public function __construct(Topic $topic)
    {
        parent::__construct();

        $this->beforeFilter('auth', ['only' => ['edit', 'update', 'destroy']]);
        $this->topic = $topic;
    }
    
    public function authorOrAdminPermissioinRequire($author_id)
    {
        if (! Entrust::can('manage_users') && $author_id != Auth::id()) {
            throw new ManageTopicsException("permission-required");
        }
    }

    public function index()
    {
        $users = User::recent()->take(48)->get();

        return View::make('users.index', compact('users'));
    }

    public function show($id)
    {
        $resume=Resume::find($id);
        $user = User::findOrFail($id);
        $topics = Topic::whose($user->id)->recent()->limit(10)->get();
        $replies = Reply::whose($user->id)->recent()->limit(10)->get();

        return View::make('users.show', compact('user', 'topics', 'replies','resume'));
    }

    public function edit($id)
    {
        $resume=Resume::find($id);
        $user = User::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($user->id);

        return View::make('users.edit', compact('user', 'topics', 'replies','resume'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($user->id);
        $data = Input::only('real_name', 'city', 'company', 'twitter_account', 'personal_website', 'signature', 'introduction');
        App::make('Phphub\Forms\UserUpdateForm')->validate($data);

        $user->update($data);

        Flash::success(lang('Operation succeeded.'));

        return Redirect::route('users.show', $id);
    }

    public function destroy($id)
    {
        $this->authorOrAdminPermissioinRequire($topic->user_id);
    }

    public function replies($id)
    {
        $user = User::findOrFail($id);
        $replies = Reply::whose($user->id)->recent()->paginate(15);

        return View::make('users.replies', compact('user', 'replies'));
    }

    public function topics($id)
    {
        $user = User::findOrFail($id);
        $topics = Topic::whose($user->id)->recent()->paginate(15);

        return View::make('users.topics', compact('user', 'topics'));
    }

    public function favorites($id)
    {
        $user = User::findOrFail($id);
        $topics = $user->favoriteTopics()->paginate(15);

        return View::make('users.favorites', compact('user', 'topics'));
    }

    public function accessTokens($id)
    {
        if(!Auth::check() || Auth::id() != $id){
            return Redirect::route('users.show', $id);
        }
        $user = User::findOrFail($id);
        $sessions = OAuthSession::where([
            'owner_type' => 'user',
            'owner_id' => Auth::id(),
            ])
            ->with('token')
            ->lists('id') ?: [];
    
        $tokens = AccessToken::whereIn('session_id', $sessions)->get();

        return View::make('users.access_tokens', compact('user', 'tokens'));
    }

    public function revokeAccessToken($token)
    {
        $access_token = AccessToken::with('session')->find($token);
        
        if(!$access_token || !Auth::check() || $access_token->session->owner_id != Auth::id()){
            Flash::error(lang('Revoke Failed'));
        }else{
            $access_token->delete();
            Flash::success(lang('Revoke success'));
        }

        return Redirect::route('users.access_tokens', Auth::id());
    }

    public function blocking($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = (!$user->is_banned);
        $user->save();

        return Redirect::route('users.show', $id);
    }

    public function githubApiProxy($username)
    {
        $cache_name = 'github_api_proxy_user_'.$username;

        //Cache 1 day
        return Cache::remember($cache_name, 1440, function () use ($username) {
            $result = (new GithubUserDataReader())->getDataFromUserName($username);
            return Response::json($result);
        });
    }

    public function githubCard()
    {
        return View::make('users.github-card');
    }

    public function refreshCache($id)
    {
        $user =  User::findOrFail($id);

        $user_info = (new GithubUserDataReader())->getDataFromUserName($user->github_name);

        // Refresh the GitHub card proxy cache.
        $cache_name = 'github_api_proxy_user_'.$user->github_name;
        Cache::put($cache_name, $user_info, 1440);

        // Refresh the avatar cache.
        $user->image_url = $user_info['avatar_url'];
        $user->cacheAvatar();
        $user->save();

        Flash::message(lang('Refresh cache success'));

        return Redirect::route('users.edit', $id);
    }

    public function regenerateLoginToken()
    {
        if(Auth::check()){
            Auth::user()->login_token = str_random(rand(20, 32));
            Auth::user()->save();
            Flash::success(lang('Regenerate succeeded.'));
        }else{
            Flash::error(lang('Regenerate failed.'));
        }

        return Redirect::route('users.show', Auth::id());
    }

    //2016-01-19
    public function EditResume()
    {
        $Resum=Resume::all(array('user_id'=>1));
        $Project=Userproject::all(array('user_id'=>1));
        $user=User::findOrFail(1);
        return View::make('register.resumes', compact('user'));
    }
    public function p_EditResume()
    {
        if(Auth::check()){
            $id=Auth::user()->id;
            $Resum=new Resume();
            $Resum->user_id=$id;
            $Resum->sex=Input::get('sex');
            $Resum->profession_id=Input::get('skill');
            $Resum->remote_status=Input::get('profession');
            $Resum->skill_id=Input::get('skill');
            $Resum->qq=Input::get('qqnumber');
            $position=Input::get('sheng').'-'.Input::get('shi').'-'.Input::get('diqu');
            $Resum->position=$position;
            $Resum->summary=Input::get('summery');
            $Resum->skill_experience=Input::get('experience');

            $projectNum=intval(Input::get('projectNum'));

            $ProjectName=Input::get('ProjectName');
            $ProjectPosition=Input::get('ProjectPosition');
            $PtStartTime=Input::get('starttime');
            $PtEndTime=Input::get('endtime');
            $ProjectUrl=Input::get('ProjectUrl');
            $Projectecperience=Input::get('Projectexperience');

            for($i=0;$i<$projectNum ;$i++){
                $OneProject=new Userproject();
                $OneProject->user_id=$id;
                $OneProject->project_name=$ProjectName[$i];
                $OneProject->role=$ProjectPosition[$i];
                $OneProject->start_time=$PtStartTime[$i];
                $OneProject->end_time=$PtEndTime[$i];
                $OneProject->url=$ProjectUrl[$i];
                $OneProject->description=$Projectecperience[$i];
                $OneProject->save();
            }
            $Resum->save();



        }
        $user=User::findOrFail(1);
        $Resum=Resum::all(array('user_id'=>1));
        $Project=Userproject::all(array('user_id'=>1));
        return View::make('register.resumes', compact('user'));
    }

    public function getavatar($id,$size){

    }
    public function vaild_email($id){

        $user=User::find($id);




        return View::make('register.email_activation',compact('user'));
    }
    public function p_vaild_email($id){
        $user=User::find($id);
        if($user->activation==null)
        {
            $user->activation=Hash::make($user->email.time());
            $user->save();
        }

        if($user->statue==0){
            //发送邮件
            $data=array('username'=>$user->username,
                'activation'=>$user->activation,
            );
            Mail::send('emails.auth.activation',$data,function($message)use ($user){
                $message->to($user->email, $user->username)->subject('欢迎注册成为OneWork会员，请尽快进行账号激活！');
            });
            return true;
        }else{
            return false;
        }
    }

}
