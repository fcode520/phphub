<?php

class RemindersController extends \BaseController
{

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('register.find_password');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        $email=Input::only('email');
        $email=$email['email'];
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('message', Lang::get($response));

			case Password::REMINDER_SENT:
                return View::make('register.find_password_ok',compact('email'));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);
        $user=DB::table('password_reminders')->where('token','=',$token)->first();
        if(is_null($user)) App::abort(404);
        $email=$user->email;
		return View::make('register.reset_password',compact('token','email'));
	}
	/**
	 * 生成密码种子
	 *
	 * @param  integer
	 * @return string
	 */
	function fetch_salt($length = 4)
	{
		$salt='';
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
	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$salt=$user->getAuthSalt();
			if(is_null($salt)){
				$salt=$this->fetch_salt(4);
			}
			$user->password = $this->compile_password($password,$salt);
			$user->salt=$salt;
			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('message', Lang::get($response));

			case Password::PASSWORD_RESET:

				return Redirect::to('/ow_login');
		}
	}

}
