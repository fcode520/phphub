<div class="col-sm-9 my-fans">
      <div class="my-fans-head">
      @if(isset($isme)&&$isme==true)
      <p>我的粉丝（{{$fans[1]}}）</p>
      @else
      <p>他的粉丝（{{$fans[1]}}）</p>
      @endif

      </div>

      <div class="my-fans-list">

        <ul>
        @foreach($fans2 as $fan)
          <li>
            <div class="fans-img">
            <a href="{{route('users.show',$fan->id)}}">  <img class="img-circle" src="{{ $fan->present()->gravatar(180) }}"></a>
            </div>

            @if(!is_null($fan->resume()->first()))
             <div class="fans-info">
             <p><a href="{{route('users.show',$fan->id)}}">{{$fan->username}}</a></p>
             <p>{{$fan->GetSkillByUserid()}}
             </p></div>
            @else
             <div class="fans-info"><p>
             <a href="{{route('users.show',$fan->id)}}">{{$fan->username}}</a></p><p>未完善简历</p></div>
            @endif

            @if(isset($isme)&&$isme==true)
                @if(Fanssystem::isFocus($fan->id))
                      <a  class="rfocusEachother yes-focus" href="#" data="{{$fan->id}}" ><span class="glyphicon glyphicon-sort"></span><i>相互关注</i></a>
                    @else
                      <a class="rFocus" href="#" data="{{$fan->id}}"><span class="glyphicon glyphicon-plus"></span><i>关注</i></a>
                @endif
            @endif

          </li>
          @endforeach
        </ul>

        <div class="change-page">
          <p>
          {{ $myfans->links('layouts.partials.pagination')}}
          </p>
        </div>
      </div>
 </div>