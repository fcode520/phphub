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
        $from= $user->fanssystem_from()->count();
        $to= $user->fanssystem_to()->count();
        $bFocus=Fanssystem::isFocus($id);
        $fans=array();
        $fans[0]=$from;
        $fans[1]=$to;
        $fans[2]=$bFocus;

        $topics = Topic::whose($user->id)->recent()->paginate(6);
        $favoritetopics = $user->favoriteTopics()->paginate(6);
        $replies = Reply::whose($user->id)->recent()->limit(6)->get();
        if(is_null($resume)){
            return View::make('usersinfo.show', compact('user', 'topics', 'replies','favoritetopics','fans'));
        }
        $skill=Skill::where('id','=',$resume->skill_id)->first()->skill;
        if(!is_null($resume)){
            $projects=$resume->userproject()->get();
            return View::make('usersinfo.show', compact('user', 'topics', 'replies','resume','projects','favoritetopics','skill','fans'));
        }

        return View::make('usersinfo.show', compact('user', 'topics', 'replies','resume','favoritetopics','fans'));
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
        if(Auth::check()){
            $user=Auth::user();
            $id=$user->id;
            $resume = User::find($id)->resume()->first();
            if(!is_null($resume)){
                $project=Resume::find($id)->userproject()->get();
            }
            $skills = Skill::lists('skill');

            $professions = Profession::lists('profession');
            return View::make('register.resumes', compact('user', 'resume', 'project', 'skills', 'professions'));
        }else{
            return Redirect::guest('ow_login');
        }

    }
    public function p_EditResume()
    {
        $rules = [
            'sex' => 'required',
            'skill' => 'required',
            'profession' => 'required',
            'qqnumber' => 'required',
            'Blog' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'summery' => 'required',
            'experience' => 'required',
        ];
        $time=true;
        $projectNum=intval(Input::get('projectNum'));
        $ProjectName=Input::get('ProjectName');
        $num=count($ProjectName);
        if($num!=$projectNum){
            $projectNum=$num;
        }
        $ProjectPosition=Input::get('ProjectPosition');

        $PtStartTime=Input::get('starttime');
        $PtEndTime=Input::get('endtime');
        if(is_null($PtStartTime)){
            $time=false;
        }
        $ProjectUrl=Input::get('ProjectUrl');
        $Projectecperience=Input::get('Projectexperience');

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withInput()->with('message',$validator->messages());
        }
        if(Auth::check()){
            $id=Auth::user()->id;
            $Resume=Resume::firstOrNew(array('user_id'=>$id));
            $Resume->user_id=$id;
            $Resume->sex=Input::get('sex');
            $Resume->profession_id=Input::get('skill');
            $Resume->remote_status=Input::get('profession');
            $Resume->skill_id=Input::get('skill');
            $Resume->qq=Input::get('qqnumber');
            $position=Input::get('province').'-'.Input::get('city').'-'.Input::get('district');
            $Resume->position=$position;
            $Resume->blog=Input::get('Blog');
            $Resume->summary=Input::get('summery');
            $Resume->skill_experience=Input::get('experience');
            Userproject::where('user_id','=',$id)->delete();

            for($i=0;$i<$projectNum ;$i++){
                $OneProject=new Userproject();
                $OneProject->user_id=$id;

                $OneProject->project_name=$ProjectName[$i];
                $OneProject->role=$ProjectPosition[$i];
                if($time==false){
                    $OneProject->start_time="1989-01-01";
                    $OneProject->end_time="1989-01-01";
                }else{
                    $OneProject->start_time=$PtStartTime[$i];
                    $OneProject->end_time=$PtEndTime[$i];
                }
                $OneProject->url=$ProjectUrl[$i];
                $OneProject->description=$Projectecperience[$i];
                $OneProject->save();
            }
            $Resume->save();
        }
        $url = Request::getRequestUri();
        if(stripos($url,'account')==false){
            return Redirect::to('/EditResume');
        }else{
            return Redirect::to('/account')->with('sucessmsg',"资料完善成功！");
        }

    }

    public function wrongTokenAjax()
    {
        if ( Session::token() !== Request::get('_token') ) {
            $response = [
                'status' => false,
                'errors' => 'Wrong Token',
            ];
            return Response::json($response);
        }
    }
    public function avatarUpload(){

        $this->wrongTokenAjax();

        if(!Auth::check()){
            Redirect::guest('ow_login');
        }
//        $this->wrongTokenAjax();
        $file = Input::file('uploadImg');
        $input = array('uploadImg' => $file);
        $rules = array(
            'image' => 'uploadImg'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $destinationPath = 'uploads/avatars/';
        $filename = $file->getClientOriginalName();
        $filePath_Name=Auth::user()->id.'/'.$filename;

        $destinationPath=$destinationPath.Auth::user()->id;
        $file->move($destinationPath, $filename);
        $Resum=new Resume();
        if($Resum->find(Auth::user()->id))
        {
//            $Resum->find(Auth::user()->id)->update(['head_img'=>$filename]);
            DB::table('Resume')
                ->where('user_id', Auth::user()->id)
                ->update(['head_img' => $filePath_Name]);
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['avatar' => $filePath_Name]);
        }else
        {
            $Resum->user_id=Auth::user()->id;
            $Resum->head_img=$filePath_Name;
            $Resum->save();
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['avatar' => $filePath_Name]);
        }

        return Response::json(
            [
                'success' => true,
                'avatar' => asset($destinationPath.'/'.$filename),
            ]
        );

    }



    public function vaild_email($id){

        $user=User::find($id);
        return View::make('register.email_activation',compact('user'));
    }
    public function p_vaild_email($id){
        if(!Auth::check()){
            return false;
        }
        $user=Auth::user();

        if($user->id != $id){
            return false;
        }

        if($user->activation==null)
        {
            $user->activation=Hash::make($user->email.time());
            $user->save();
        }

        if($user->statue==0){
            //发送邮件
            $data=array('username'=>$user->username,
                'activation'=>$user->activation,
                'email'=>$user->email,
            );
            Mail::send('emails.auth.activation',$data,function($message)use ($user){
                $message->to($user->email, $user->username)->subject('欢迎注册成为OneWork会员，请尽快进行账号激活！');
            });
            return true;
        }else{
            return false;
        }
    }

    public function changeheader(){
        $this->wrongTokenAjax();
        $imgdata=Input::get('imgdata');
        if(is_null($imgdata)){
            return 'false';
        }
        $img=str_replace('data:image/png;base64,','',$imgdata);
        $img=str_replace(' ','+',$img);
        $data=base64_decode($img);
        $fileName=Auth::user()->id.'/avatar.png';
        $destinationPath = 'uploads/avatars/'.Auth::user()->id;
        if(!is_dir($destinationPath)){
                if(!mkdir($destinationPath,0777)){
                    return false;
                }
        }
        $file=$destinationPath.'/avatar.png';

        $sucess=file_put_contents($file,$data);
        $image_size   =   getimagesize($file);
        print( "文件的格式为： ".$image_size[2]);
        if($sucess)
        {
            $Resum=new Resume();
            if($Resum->find(Auth::user()->id))
            {
//            $Resum->find(Auth::user()->id)->update(['head_img'=>$filename]);
                DB::table('Resume')
                    ->where('user_id', Auth::user()->id)
                    ->update(['head_img' => $fileName]);
                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['avatar' => $fileName]);
            }else
            {
                $Resum->user_id=Auth::user()->id;
                $Resum->head_img=$fileName;
                $Resum->save();
                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['avatar' => $fileName]);
            }
            return $file;
        }

        return 'false';

    }

    public function postfocus(){
        if(Auth::check()){

            $toid=input::get('_ntoid');
            $bFocus=Fanssystem::isFocus($toid);
            if($bFocus){
                $fans=Fanssystem::findFans($toid);
                $fans->delete();
                return "关注";
            }
            $fans=new Fanssystem();
            $fans->from_user_id=Auth::id();
            $fans->to_user_id=$toid;
            $fans->save();
            return "取消关注";
        }
        return "请登录后再进行关注";
    }
    public function showfans($id){
        if(Auth::id()==$id){
            $isme=true;
        }
       // $fanssss=Fanssystem::whereIn('from_user_id', array_pluck(Fanssystem::where('from_user_id', 1)->get()->toArray(), 'to_user_id'))->where('to_user_id', 1)->get();
        $user = User::findOrFail($id);
        $from= $user->fanssystem_from()->count();
        $to= $user->fanssystem_to()->count();
        $bFocus=Fanssystem::isFocus($id);
        $fans=array();
        $fans[0]=$from;
        $fans[1]=$to;
        $fans[2]=$bFocus;
        //关注我的
        $myfans=$user->fanssystem_to()->paginate(10);
        $fans2=array();
        foreach($myfans as $myfan){
            $fans2[]=$myfan->fromuser()->first();
        }
        //我与粉丝的关系
        /*
         * 1 他关注我 我未关注他
         * 1 他关注我  我也关注他
         * */

        //我关注的
//        $myfocus=$user->fanssystem_from()->paginate(1);
//        $focus=array();
//        foreach($myfocus as $focu){
//            $focus[]=$focu->touser()->first();
//        }

        return View::make('usersinfo.fans',compact('user','fans','myfans','fans2','isme'));
    }
    public  function  showfocus($id){
        if(Auth::id()==$id){
            $isme=true;
        }
        $user = User::findOrFail($id);
        $from= $user->fanssystem_from()->count();
        $to= $user->fanssystem_to()->count();
        $bFocus=Fanssystem::isFocus($id);
        $fans=array();
        $fans[0]=$from;
        $fans[1]=$to;
        $fans[2]=$bFocus;

        $myfocus=$user->fanssystem_from()->paginate(10);
        $fans2=array();
        $fansState=array();
        foreach($myfocus as $focus){
            $fans2[]=$focus->touser()->first();
            $tmp=$focus->touser()->first();
            $var=$tmp->present()->gravatar(180);
        }
        return View::make('usersinfo.focus',compact('user','fans','myfocus','fans2','isme'));
    }

}
