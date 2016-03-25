<div class="col-sm-9 my-fans">
      <div class="my-fans-head">
        <p>我的粉丝（{{$fans[1]}}）</p>
      </div>

      <div class="my-fans-list">

        <ul>
        @foreach($fans2 as $fan)
          <li>
            <div class="fans-img"><img class="img-circle" src="{{ $fan->present()->gravatar(180) }}"></div>

            @if(!is_null($fan->resume()->first()))
             <div class="fans-info"><p>{{$fan->username}}</p><p>{{$fan->GetSkillByUserid()}}</p></div>
            @else
             <div class="fans-info"><p>{{$fan->username}}</p><p>未完善简历</p></div>
            @endif
            @if(Fanssystem::isFocus($fan->id))
                  <a href="#" data="{{$fan->id}} class="yes-focus"><span class="glyphicon glyphicon-sort"></span><i>相互关注</i></a>
                @else
                  <a href="#"><span data="{{$fan->id}} "class="glyphicon glyphicon-plus"></span><i>关注<i/></a>
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