<?php

//use Phphub\Listeners\GithubAuthenticatorListener;
//use Phphub\Listeners\UserCreatorListener;

class ow_AuthController extends \BaseController
{
    /**
     * Authenticate with github
     */
    public function show_login()
    {
        if(Auth::check()){
            return Redirect::intended('/');
        }
        return View::make("register.loginindex");
    }
    public function Do_Login()
    {
        if(Auth::attempt(array('username'=>Input::get('username'),'password'=>Input::get('password')),true)
            ||Auth::attempt(array('email'=>Input::get('username'),'password'=>Input::get('password')),true)){
            return Redirect::intended('/');
        }else{

            return Redirect::to('/ow_login')->with('message', '登录失败，账户不存在或密码错误')->withInput();
        }
    }
    public function show_register(){
            return View::make('register.registerindex');
    }
    /**
     * 生成密码种子
     *
     * @param  integer
     * @return string
     */
    function fetch_salt($length = 4)
    {
        $salt = '';
        for ($i = 0; $i < $length; $i++)
        {
            $salt .= chr(rand(97, 122));
        }

        return $salt;
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
    public function ow_Auth_register()
    {
        $validator= Validator::make(Input::all(),User::$rules);
        if($validator->passes()){
            $salt = $this->fetch_salt(4);
            $users=User::where('email','=',Input::get('email'))->first();
            $user =new User;
            $user->username=Input::get('username');
            $user->email=Input::get('email');
            $user->salt=$salt;
            $user->password=$this->compile_password(Input::get('password'), $salt);
            $user->activation=Hash::make(Input::get('email').time());
            $user->status=0;
            $user->save();
            $data=array('username'=>$user->username,
                'activation'=>$user->activation,
                );
            Mail::send('emails.auth.activation',$data,function($message){
                $message->to(Input::get('email'), Input::get('username'))->subject('欢迎注册成为OneWork会员，请尽快进行账号激活！');
            });

            return View::make('register.email_activation',compact('user'));

        }else{
            return Redirect::to('/ow_register')->with('message', $validator->messages())->withInput();
        }
    }
    public function ow_registerok(){
        return view::make('register.registerok');
    }
    public function SendActivationEmail(){
        if(Auth::check()){
            $user=Auth::user();

            if($user->activation==null){
                $user->activation=Hash::make(Input::get('email').time());
                $user->save();
            }
            $data=array('username'=>$user->username,
                'activation'=>$user->activation,
                'email'=>$user->email,
            );
            Mail::send('emails.auth.activation',$data,function($message)use ($user) {
                $message->to($user->email, $user->username)->subject('欢迎注册成为OneWork会员，请尽快进行账号激活！');
            });
            return View::make('register.email_activation',compact('user'));
        }
                return Redirect::back();
    }
    public function activation(){
        if(!empty($_GET['activation']) && isset($_GET['activation'])){
            $code=mysql_escape($_GET['activation']);
            $user_count = User::where('activation',$code)->count();
            $User=User::where('activation', '=', $code)->firstOrFail();;

            if($user_count > 0)
            {
                $count=DB::table('users')->where('activation',$code)->where('status','0')->count();
                if($count == 1)
                {
                    $db_res = DB::table('users')->where('activation',$code)->update(array('status' => 1));
                    if($db_res == 1){
                        Auth::login($User);
                        return View::make('register/activation_to_resumes');
                    }
                }
                else
                {
                    return Redirect::to('ow_login')->with('message', '您的账号已经激活无需再次激活!');
                }

            }
            else {
                return Redirect::to('ow_register')->with('message', '您的账号存在');
            }
        }
    }

    public function find_password(){
        return View::make('register.find_password');
    }

    public function p_find_password(){

    }




    public function logout()
    {
        Auth::logout();
        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('home');
    }

    public function loginRequired()
    {
        return View::make('auth.loginrequired');
    }

    public function adminRequired()
    {
        return View::make('auth.adminrequired');
    }

    /**
     * Shows a user what their new account will look like.
     */
    public function create()
    {
        if (! Session::has('userGithubData')) {
            return Redirect::route('login');
        }
        $githubUser = array_merge(Session::get('userGithubData'), Session::get('_old_input', []));
        return View::make('auth.signupconfirm', compact('githubUser'));
    }

    /**
     * Actually creates the new user account
     */
    public function store()
    {
        if (! Session::has('userGithubData')) {
            return Redirect::route('login');
        }
        $githubUser = array_merge(Session::get('userGithubData'), Input::only('name', 'github_name', 'email'));
        unset($githubUser['emails']);
        return App::make('Phphub\Creators\UserCreator')->create($this, $githubUser);
    }

    public function userBanned()
    {
        if (Auth::check() && !Auth::user()->is_banned) {
            return Redirect::route('home');
        }

        //force logout
        Auth::logout();
        return View::make('auth.userbanned');
    }

    /**
     * ----------------------------------------
     * UserCreatorListener Delegate
     * ----------------------------------------
     */

    public function userValidationError($errors)
    {
        return Redirect::to('/');
    }

    public function userCreated($user)
    {
        Auth::login($user, true);
        Session::forget('userGithubData');

        Flash::success(lang('Congratulations and Welcome!'));

        return Redirect::intended();
    }

    /**
     * ----------------------------------------
     * GithubAuthenticatorListener Delegate
     * ----------------------------------------
     */

    // 数据库找不到用户, 执行新用户注册
    public function userNotFound($githubData)
    {
        Session::put('userGithubData', $githubData);
        return Redirect::route('signup');
    }

    // 数据库有用户信息, 登录用户
    public function userFound($user)
    {
        Auth::login($user, true);
        Session::forget('userGithubData');

        Flash::success(lang('Login Successfully.'));

        return Redirect::intended();
    }

    // 用户屏蔽
    public function userIsBanned($user)
    {
        return Redirect::route('user-banned');
    }
}
