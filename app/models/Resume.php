<?php


class Resume extends \Eloquent {
	protected $table='Resume';

	protected $fillable = [];

	use SoftDeletingTrait;
	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo('User');
	}
	public function userproject(){
		return $this->hasMany('userproject');
	}


	//api
	public function ResumesByid($id){

	}
}