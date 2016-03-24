<?php
class Fanssystem extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
	protected $table = 'fanssystem';
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsToMany('User');
    }
    //我关注
      public function fromuser(){
          return $this->belongsTo('User','from_user_id','id');
    }
    //关注我
    public function touser(){
            return $this->belongsTo('User','to_user_id','id');
    }

   public static function  isFocus($id)
   {
        if(Auth::check()){
            $count=Fanssystem::where('from_user_id','=',Auth::id())->where('to_user_id','=',$id)->count();
            if($count){
                return true;
            }
        }
        return false;
   }
    //查找当前用户与制定用户的关注关系
    public static  function findFans($id){
         return Fanssystem::where('from_user_id','=',Auth::id())->where('to_user_id','=',$id)->firstOrFail();
    }

}