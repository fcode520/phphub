<?php

class AccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::check()){
		return 	Redirect::intended('/');
		}
		$notifications = Auth::user()->notifications();
        $userID=Auth::user()->id;
		$notifications->sysNotifyCount=Notification::WithNoType('new_reply')->ToWhom($userID)->count();
		$notifications->repliesCount=Notification::WithType('new_reply')->ToWhom($userID)->count();
		Auth::user()->notification_count = 0;
		Auth::user()->save();

		return View::make('account.index', compact('notifications'));
	}
    public function replies(){
		if(!Auth::check()){
			Redirect::intended('/');
		}
        $notifications=Notification::where('type','=','new_reply')->where('user_id','=',Auth::user()->id)->get();
        $userID=Auth::user()->id;
		$notifications->sysNotifyCount=Notification::WithNoType('new_reply')->ToWhom($userID)->count();
		$notifications->repliesCount=Notification::WithType('new_reply')->ToWhom($userID)->count();
        return View::make('account.index', compact('notifications'));
    }
    public function  sysnotify(){
		if(!Auth::check()){
			Redirect::intended('/');
		}
        $notifications=Notification::where('type','<>','new_reply')->where('user_id','=',Auth::user()->id)->get();
        $userID=Auth::user()->id;
		$notifications->sysNotifyCount=Notification::WithNoType('new_reply')->ToWhom($userID)->count();
		$notifications->repliesCount=Notification::WithType('new_reply')->ToWhom($userID)->count();
        return View::make('account.index', compact('notifications'));
    }
	public function personalsettings(){
		if(!Auth::check())
		{

		return	Redirect::guest('/ow_login');
		}

		$resume=Auth::user()->resume()->first();
		if(is_null($resume)){
			Flash::success("请先完善资料，在查看箱子资料");
			return	Redirect::route('EditResume');
		}
		$projects=Auth::user()->projects()->first();
		return View::make('account.setting',compact('resume','projects'));
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
