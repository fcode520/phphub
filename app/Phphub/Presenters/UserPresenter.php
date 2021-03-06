<?php namespace Phphub\Presenters;

use Laracasts\Presenter\Presenter;
use Route;
use Config;
use User;
use Role;

class UserPresenter extends Presenter
{
    /**
     * Present a link to the user gravatar.
     */
    public function gravatar($size = 80)
    {
        if (Config::get('app.url_static')) {
            //Using Qiniu image processing service.
            return cdn('uploads/avatars/'.$this->avatar)."?imageView2/1/w/{$size}/h/{$size}";
        }
        if($this->avatar=='def_avatars.png')
        {
            $randnum=rand(0,10);
            $randnum = sprintf("%02d", $randnum);
            $strAvatar="Default/".$randnum."_avatar_max.jpg";
//            $userid=$this->id;
            $User= User::findOrFail($this->id);
            $User->avatar=$strAvatar;
            $User->save();
            return cdn('uploads/avatars/'.$strAvatar)."?imageView2/1/w/{$size}/h/{$size}";

        }
         return cdn('uploads/avatars/'.$this->avatar)."?imageView2/1/w/{$size}/h/{$size}";

    }

    public function loginQR($size = 80)
    {
        if(!$this->login_token){
            $this->entity->login_token = str_random(20);
            $this->entity->save();
        }

        return \QrCode::format('png')
            ->size(200)
            ->errorCorrection('L')
            ->margin(0)
            ->generate($this->github_name . ',' . $this->login_token);
    }

    public function userinfoNavActive($anchor)
    {
        return Route::currentRouteName() == $anchor ? 'active' : '';
    }

    public function hasBadge()
    {
        $relations = Role::relationArrayWithCache();
        $user_ids = array_pluck($relations, 'user_id');
        return in_array($this->id, $user_ids);
    }

    public function badgeName()
    {
        $relations = Role::relationArrayWithCache();
        $relation = array_first($relations, function($key, $value)
        {
            return $value->user_id == $this->id;
        });

        if (!$relation) {
            return;
        }

        $roles = Role::rolesArrayWithCache();

        $role = array_first($roles, function($key, $value) use( &$relation)
        {
            return $value->id == $relation->role_id;
        });

        return lang($role->name);
    }
}
