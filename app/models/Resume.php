<?php


class Resume extends \Eloquent {
	protected $table='Resume';

	protected $fillable = ['user_id','id'];

	use SoftDeletingTrait;
	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function userproject(){

		return $this->hasMany('Userproject','user_id','user_id');
	}

    public function skill(){
        return $this->hasOne('skill','id','skill_id');
    }

	//api
	public function ResumesByid($id){
		return $this->where('user_id','=',$id)->get();
	}
    public static  function remotercount(){
        return Resume::where('remote_status','=',1)->orWhere('remote_status','=',2)->count();
    }
}