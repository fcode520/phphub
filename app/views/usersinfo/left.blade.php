<div class="col-sm-3 exchange-side homepage-side">
       <div class="personal-info new-personal-info">
         <div class="new-personal-photo"><img src="{{ $user->present()->gravatar(180) }}"></div>
         <div class="new-personal-name">
           <h2>{{ $user->username }}</h2>
           <p>
            <p><span data-toggle="tooltip" data-placement="top" title="所在地" class="glyphicon glyphicon-map-marker"></span>
                @if(isset($resume))
                    @if($resume->position=="")
                         {{'地球'}}
                        @else
                         {{substr($resume->position,0,strpos($resume->position,'-'))}}
                        @endif


               @else
               {{'地球'}}
               @endif
            <span class="new-personal-work" data-toggle="tooltip" data-placement="top" title="职业">
            @if(isset($skill))
            {{$skill}}
             @else
              {{'神秘的职位'}}
               @endif
            </span></p>

            <p>
            <span data-toggle="tooltip" data-placement="top" title="从业状态" class="computer"></span>
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
             <p>
                 <span data-toggle="tooltip" data-placement="top" title="工作经验" class="computer"></span>
                 @if(isset($resume))
                    {{$resume->work_experience}}年
                     @else
                     0年
                     @endif
             </p>
            </p>
         </div>
         <div class="clearfix"></div>
         <div class="new-three-info clearfix">
           <ul>
               <li><span>{{$user->getTopicsups()}}</span><p>赞</p></li>
               {{--<li><span>{{$fans[0]}}</span><p>关注</p></li>--}}
                <li><span>{{$fans[0]}}</span><p><a href="{{route('ufocus',$user->id)}}">关注</a></p></li>

               {{--<li><span>{{$fans[1]}}</span><p>粉丝</p></li>--}}
               <li><span>{{$fans[1]}}</span><p><a href="{{route('fans',$user->id)}}">粉丝</a></p></li>
           </ul>
         </div>
                        @if(isset($currentUser))
                        @if($currentUser->id == $user->id)
                                <div class="new-follow"><a  class="btn btn-success" href="{{route('editsetting')}}">{{"修改资料"}}</a></div>
                        @else
                           <div class="new-follow"><a id="Focus" data="{{$user->id}}" class="btn btn-success" href="#">{{$fans[2]?'取消关注':'关注'}}</a></div>
                        @endif
                        @else
                        <div class="new-follow" data-toggle="tooltip" data-placement="top" title="请登陆后进行关注！"><a id="Focus" data="{{$user->id}}" class="btn btn-success disabled" href="#">{{$fans[2]?'取消关注':'关注'}}</a></div>
                        @endif


         {{--<p><a href="#">联系他</a></p>--}}
           @if(isset($resume))
               <p><a  href="tencent://message/?uin={{$resume->qq}}&amp;Site=im.qq.com&amp;Menu=yes">联系他</a>
                </p>

           @endif
       </div>
</div>