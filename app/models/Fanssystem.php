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
    //获取当前用户相互关注的信息
    public static  function findFans($id){
        return Fanssystem::where('from_user_id','=',Auth::id())->where('to_user_id','=',$id)->firstOrFail();

    }
    public static function FindMyFans($id){
        //  $fanssss=Fanssystem::whereIn('from_user_id', array_pluck(Fanssystem::where('from_user_id', 1)->get()->toArray(), 'to_user_id'))->where('to_user_id', 1)->get();
        $fansss=DB::select('Select * FROM `fanssystem` s WHERE s.`from_user_id` IN ( SELECT t.`to_user_id` FROM `fanssystem` t WHERE t.`from_user_id`=$id ) AND s.`to_user_id`=$id');
        return $fansss;
    }
    public static function IsFocusHim($id){
       return Fanssystem::where('from_user_id','=',Auth::id())->where('to_user_id','=',$id)->count();
    }
}