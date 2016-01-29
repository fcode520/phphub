<?php

class Userproject extends \Eloquent {

	protected $table='project_Experience';


//	use SoftDeletingTrait;
//	protected $dates = ['deleted_at'];

	protected $fillable = [];

	public function resume(){
		return $this->belongsTo('resume');
	}
	public function users(){
		return $this->belongsTo('users');
	}
}