<div class="col-sm-3 exchange-side homepage-side">
       <div class="personal-info new-personal-info">
         <div class="new-personal-photo"><img src="{{ $user->present()->gravatar(180) }}"></div>
         <div class="new-personal-name">
           <h2>{{ $user->username }}</h2>
           <p><span class="glyphicon glyphicon-map-marker"></span>{{substr($resume->position,0,strpos($resume->position,'-'))}}<span class="new-personal-work">

           @if(isset($resume->skill->skill))
            {{$resume->skill->skill}}
            @endif
           </span></p>
           <p><span class="computer"></span>
            @if($resume->remote_status==2)
            {{"非远程工作者"}}
            @else
             {{$resume->remote_status==0?"全职远程工作者":"兼职远程工作者"}}
            @endif
            </p>
         </div>
         <div class="clearfix"></div>
         <div class="new-three-info clearfix">
           <ul>
               <li><span>20</span><p>赞</p></li>
               <li><span>20</span><p>关注</p></li>
               <li><span>120</span><p>粉丝</p></li>
           </ul>
         </div>
         <p class="new-follow"><a class="btn btn-success" href="#">关注</a></p>
         <p><a href="#">联系他</a></p>
       </div>
</div>