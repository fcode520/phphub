<?php

class Navigation extends \Eloquent {
    protected $table='NavigationItems';
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    public  function navigationcategory(){
        $this->belongsTo('NavigationCategory');
    }
}