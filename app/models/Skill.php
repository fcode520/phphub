<?php

class Skill extends \Eloquent {
	protected $fillable = [];
    protected $table = 'skill';


    public function resume(){
        return $this->belongsTo('Resume');
    }
}