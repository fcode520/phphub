<div class="col-sm-3 exchange-side homepage-side">
       <div class="personal-info new-personal-info">
         <div class="new-personal-photo"><img src="{{ $user->present()->gravatar(180) }}"></div>
         <div class="new-personal-name">
           <h2>{{ $user->username }}</h2>
           <p>
               <span class="glyphicon glyphicon-map-marker"></span>
               @if(isset($resume))
               {{substr($resume->position,0,strpos($resume->position,'-'))}}
               @else
               {{'地球'}}
               @endif
               <span class="new-personal-work">
            @if(isset($skill))
                   {{$skill}}
            @else
                   {{'未知技能'}}
                @endif
           </span></p>
           <p><span class="computer"></span>
               @if(isset($resume))
            @if($resume->remote_status==2)
            {{"非远程工作者"}}
            @else
             {{$resume->remote_status==0?"全职远程工作者":"兼职远程工作者"}}
            @endif
               @else
                   {{'未填写'}}
               @endif
            </p>
         </div>
         <div class="clearfix"></div>
         <div class="new-three-info clearfix">
           <ul>
               <li><span>{{$user->getTopicsups()}}</span><p>赞</p></li>
               <li><span>{{$fans[0]}}</span><p>关注</p></li>
               <li><span>{{$fans[1]}}</span><p>粉丝</p></li>
           </ul>
         </div>
         <p class="new-follow"><a id="Focus" data="{{$user->id}}" class="btn btn-success" href="#">{{$fans[2]?'取消关注':'关注'}}</a></p>
         <p><a href="#">联系他</a></p>
       </div>
</div>