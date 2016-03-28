<?php

class ProjectVote extends \Eloquent {
	protected $fillable = [];
    protected $table = 'projectvote';
    use SoftDeletingTrait;

    public function users(){
        return $this->belongsTo('users');
    }

    public function projects(){
        return $this->belongsTo('Userproject');
    }
}