<div class="col-sm-9 my-fans">
      <div class="my-fans-head">
      @if(isset($isme)&&$isme==true)
      <p>我的关注（{{$fans[0]}}）</p>
      @else
      <p>他的关注（{{$fans[0]}}）</p>
      @endif
      </div>

      <div class="my-fans-list">

        <ul>
        @foreach($fans2 as $fan)
          <li>
            <div class="fans-img">
            <a href="{{route('users.show',$fan->id)}}">
            <img class="img-circle" src="{{ $fan->present()->gravatar(180) }}">
            </a>
            </div>

            @if(!is_null($fan->resume()->first()))
             <div class="fans-info">
             <p><a href="{{route('users.show',$fan->id)}}">{{$fan->username}}</a></p>
             <p>{{$fan->GetSkillByUserid()}}</p></div>
            @else
             <div class="fans-info">
             <p><a href="{{route('users.show',$fan->id)}}">{{$fan->username}}</a></p>
             <p>未完善简历</p></div>
            @endif
            @if(isset($isme))

                @if(Fanssystem::isFocusMe($fan->id))
                      <a  class="rEachother yes-focus" href="#" data="{{$fan->id}}" ><span class="glyphicon glyphicon-sort"></span><i>相互关注</i></a>
                    @else
                      <a class="rEachother yes-focus" href="#" data="{{$fan->id}}"  class="rFocus yes-focus"><span class="glyphicon glyphicon-ok"></span><i>已关注</i></a>
                @endif
            @endif

          </li>
          @endforeach
        </ul>

        <div class="change-page">
          <p>
          {{ $myfocus->links('layouts.partials.pagination')}}
          </p>
        </div>
      </div>
 </div>