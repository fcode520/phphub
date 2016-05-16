<?php

class NavigationCategory extends \Eloquent {
    protected $table='NavigationCategory';
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    public function navigation(){
        $this->hasMany('Navigation');
    }
}