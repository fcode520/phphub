<div class="col-sm-9 exchange homepage-main">
      <div class="exchange-head new-personal-head">
        <ul>
        @if($currentUser && ($currentUser->id == $user->id))
          <li class="act"><a href="#">我的文章</a></li>
          <li ><a href="#">我的收藏</a></li>
          <li ><a href="#">我的回复</a></li>
          @else
           <li class="act"><a href="#">他的文章</a></li>
                    <li ><a href="#">他的收藏</a></li>
                    <li ><a href="#">他的回复</a></li>
          @endif
          {{--<li><a href="#">TA的资料</a></li>--}}
        </ul>
        <span class="new-line"></span>
      </div>

@include('usersinfo.topics')


@include('usersinfo.user_summary')

@include('usersinfo.user_products')
    </div>