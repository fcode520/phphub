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
        // Redirect from Github
        return View::make("register.loginindex");
    }
    public function ow_Auth_login()
    {
        if(Auth::attempt(array('username'=>Input::get('username'),'password'=>Input::get('password')))){
          //  return "登录成功";
            return Redirect::to('www.baidu.com');//->with('message', '欢迎登录');
        }else{

            return Redirect::to('/ow_login')->with('message', '登录好像失败了亲!');
        }
    }
    public function show_register(){
 return View::make('register.registerindex');
    }
    public function ow_Auth_register(){
        $validator= Validator::make(Input::all(),User::$rules);
        if($validator->passes()){
            $user =new User;
            $user->username=Input::get('username');
            $user->email=Input::get('email');
            $user->password=Hash::make(Input::get('password'));
            $user->save();
//            return Redirect::intended();

        }else{
            return "不可以注册";
        }
    }
    public function ow_registerok(){
        return view::make('register.registerok');
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
