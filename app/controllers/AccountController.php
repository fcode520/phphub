<?php

class AccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(!Auth::check())
        {
            return	Redirect::guest('/ow_login');
        }

        $resume=Auth::user()->resume()->first();
        if(is_null($resume)){
            Flash::success("请先完善资料，在查看资料");
            return	Redirect::route('editsetting')->with('message',"请先完善资料，在查看资料");
        }
        $projects=Auth::user()->projects()->first();
        $skill=Skill::where('id','=',$resume->skill_id)->first()->skill;
        return View::make('account.index',compact('resume','projects','skill'));
//		if(!Auth::check()){
//		return 	Redirect::intended('/');
//		}
//
//		return View::make('account.index');
	}
    public function replies(){
		if(!Auth::check()){
			Redirect::intended('/');
		}
        $notifications=Notification::where('type','=','new_reply')->where('user_id','=',Auth::user()->id)->get();
        $userID=Auth::user()->id;
		$notifications->sysNotifyCount=Notification::WithNoType('new_reply')->ToWhom($userID)->count();
		$notifications->repliesCount=Notification::WithType('new_reply')->ToWhom($userID)->count();
        return View::make('account.notify', compact('notifications'));
    }
    public function  sysnotify(){
		if(!Auth::check()){
			Redirect::intended('/');
		}
        $notifications=Notification::where('type','<>','new_reply')->where('user_id','=',Auth::user()->id)->get();
        $userID=Auth::user()->id;
		$notifications->sysNotifyCount=Notification::WithNoType('new_reply')->ToWhom($userID)->count();
		$notifications->repliesCount=Notification::WithType('new_reply')->ToWhom($userID)->count();
        return View::make('account.notify', compact('notifications'));
    }
	public function personalsettings(){
		if(!Auth::check())
		{
		return	Redirect::guest('/ow_login');
		}

		$resume=Auth::user()->resume()->first();
		if(is_null($resume)){
			Flash::success("请先完善资料，在查看资料");
			return	Redirect::route('editsetting')->with('message',"请先完善资料，在查看资料");
		}
		$projects=Auth::user()->projects()->first();
		return View::make('account.setting',compact('resume','projects'));
	}
    public function ac_if_setting(){
        if(!Auth::check())
        {

            return	Redirect::guest('/ow_login');
        }

        $resume=Auth::user()->resume()->first();
        if(is_null($resume)){
            Flash::success("请先完善资料，在查看箱子资料");
            return	Redirect::route('EditResume')->with('message','请先完善资料，在查看箱子资料');
        }
        $projects=Auth::user()->projects()->first();
        return View::make('account.iframesetting',compact('resume','projects'));
    }
	public function editresume(){
		if(Auth::check()){
			$user=Auth::user();
			$id=$user->id;
			$resume = User::find($id)->resume()->first();
			if(!is_null($resume)){
				$project=Resume::find($id)->userproject()->get();
			}
			return View::make('account.resumes', compact('user','resume','project'));
		}else{
			return Redirect::guest('ow_login');
		}
	}
	public function topics(){

		$topics = Topic::whose(Auth::user()->id)->recent()->limit(10)->get();
		return View::make('account.topics',compact('topics'));
	}
    public function notify(){
        $notifications = Auth::user()->notifications();
        $userID=Auth::user()->id;
        $notifications->sysNotifyCount=Notification::WithNoType('new_reply')->ToWhom($userID)->count();
        $notifications->repliesCount=Notification::WithType('new_reply')->ToWhom($userID)->count();
        Auth::user()->notification_count = 0;
        Auth::user()->save();

        return View::make('account.notify', compact('notifications'));
    }
    public function editsetting(){
        if(Auth::check()){
            $user=Auth::user();
            $id=$user->id;
            $resume = User::find($id)->resume()->first();
            if(!is_null($resume)){
//                $project=Resume::find($id)->userproject()->get();
                $project=Userproject::where('user_id','=',$id)->get();
            }
            $skills = Skill::lists('skill');
            $professions = Profession::lists('profession');
            return View::make('account.editsetting', compact('user','resume','project','skills','professions'));
        }else{
            return Redirect::guest('ow_login');
        }
    }
    public function changepassword(){
        if(Auth::check()){
            return View::make('account.changepwd');
        }else
        {
            return Redirect::guest('/');
        }
    }
    /**
     * 根据 salt 混淆密码
     *
     * @param  string
     * @param  string
     * @return string
     */
    function compile_password($password, $salt)
    {
        $password = md5(md5($password) . $salt);

        return $password;
    }
    /**
     * 用户密码验证
     *
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    public function check_password($password, $db_password, $salt)
    {
        $password = $this->compile_password($password, $salt);

        if ($password == $db_password)
        {
            return true;
        }

        return false;

    }
    public function post_changepwd(){

        if(Auth::check()){
            $oldpwd=Input::get('old_pwd');
            $password=Input::get('password');
            $confirmPassword=Input::get('confirmPassword');
            $retArr=array();
            if(empty($oldpwd) or empty($password) or empty($confirmPassword) or $password!=$confirmPassword){
                $retArr[0]='error';
                $retArr[1]="密码不能为空";
                return $retArr;
            }
            if(!$this->check_password($oldpwd,Auth::user()->password,Auth::user()->getAuthSalt()))
            {
                $retArr[0]='error';
                $retArr[1]="旧密码不正确";
               return $retArr;
            }

            $newpwd=$this->compile_password($confirmPassword,Auth::user()->getAuthSalt());
            $user=Auth::user();
            $user->password=$newpwd;
            $user->save();
            Auth::logout();

            $retArr[0]='sucess';
            $retArr[1]="密码修改成功";
            return $retArr;


        }else{
            $retArr[0]='nologin';
            $retArr[1]="请登陆后在进行密码修改操作";
            return $retArr;
        }
    }
public function changeheader(){
        return View::make('account.changeheader');
    }

    function  NotifyDelete($nid){
        if(Auth::check()){
//            $info=Auth::user()->notifications()->where('user_id','=',Auth::user()->id)->andwhere('id','=',$nid)->get();
            $info=Notification::where('user_id','=',Auth::user()->id)->where('id','=',$nid)->first();
            if(is_null($info)){
                return "false";
            }
            //查看 该同志ID 是否属于目前登录用户。
            $info->delete();
            return "true";
        }
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
