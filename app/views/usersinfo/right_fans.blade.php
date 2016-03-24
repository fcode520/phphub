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

            <a href="#"><span class="glyphicon glyphicon-plus"></span>关注</a>
          </li>
          @endforeach
        </ul>

        <div class="change-page">
          <p>
          {{ $myfans->links()}}
            {{--<a href="#">上一页</a>--}}
            {{--<a href="#">1</a>--}}
            {{--<a href="#">2</a>--}}
            {{--<a href="#">3</a>--}}
            {{--<a href="#">4</a>--}}
            {{--<a href="#">5</a>--}}
            {{--<a href="#">下一页</a>--}}
          </p>
        </div>
      </div>
 </div>