@extends('home.default')


@section('css')
    <link rel="stylesheet" href="{{cdn('assets/onework_css/layout.css')}}">
@stop

@section('content')

  <div class="new-index">

    <div class="container">
      <div class="new-index-head clearfix">
        <img src="{{cdn("assets/images/x_logo.png")}}"/>
        <div class="new-index-nav">
          <ul>
            <li><a href="{{route('home')}}">社区</a></li>
            <li><a href="{{url('nodes/6')}}">工作</a></li>
            <li><a href="{{url('nodes/7')}}">寻求团队</a></li>
            <li><a href="http://hao.apcow.com">网址导航</a></li>
          </ul>
          <span>new</span>
        </div>
        <div class="new-index-map">
          <img src="{{cdn("assets/images/x_map.png")}}">
          <div class="new-index-map-text">
            <p>聚集远程工作者的社区</p>
            <p>快速找到远程团队</p>
            <a href="{{url('/nodes/7')}}">申请加入远程团队</a>
          </div>
        </div>
        <div class="new-index-pic">
          <p>远程团队TEAM<span>+</span></p>
          <p>加入团队，共谋发展</p>
          <div class="new-index-pic-tab">
            <div class="new-index-pic-box">
              <ul>
                <li>
                  <img src="{{cdn("assets/images/x_pic1.png")}}" alt="">
                  <div class="new-index-pic-info">
                    <p>远程外包团队TEAM</p>
                    <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                  </div>
                </li>
                <li>

                  <img src="{{cdn("assets/images/x_pic2.png")}}" alt="">
                  <div class="new-index-pic-info">
                    <p>设计外包团队</p>
                    <p>提供整体UI设计服务，为客户提供从可用性评估、交互策划、
                    界面设计、产品包装等一站式设计服务。</p>
                  </div>
                </li>
                <li>
                  <img src="{{cdn("assets/images/x_pic3.png")}}" alt="">
                  <div class="new-index-pic-info">
                    <p>远程外包团队TEAM</p>
                    <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                  </div>
                </li>
                <li>
                  <img src="{{cdn("assets/images/x_pic2.png")}}" alt="">
                  <div class="new-index-pic-info">
                    <p>远程外包团队TEAM</p>
                    <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                  </div>
                </li>
                <li>
                   <img src="{{cdn("assets/images/x_pic2.png")}}" alt="">
                  <div class="new-index-pic-info">
                    <p>远程外包团队TEAM</p>
                    <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                  </div>
                </li>
              </ul>
            </div>
            <span class="pic-tab-left glyphicon glyphicon-chevron-left"></span>
            <span class="pic-tab-right glyphicon glyphicon-chevron-right"></span>
          </div>
          <div class="new-index-pic-list">
            <ul>
              <li>
                <img src="{{cdn("assets/images/x_pic2.png")}}" alt="">
                <div class="new-index-pic-info">
                  <p>远程外包团队TEAM</p>
                  <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                </div>
              </li>
              <li>
                 <img src="{{cdn("assets/images/x_pic2.png")}}" alt="">
                <div class="new-index-pic-info">
                  <p>远程外包团队TEAM</p>
                  <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                </div>
              </li>
              <li>
                 <img src="{{cdn("assets/images/x_pic3.png")}}" alt="">
                <div class="new-index-pic-info">
                  <p>远程外包团队TEAM</p>
                  <p>多年外包经验，长期承接外包，团队成员来自大型互联网公司</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="new-index-unit-a">
    <p>2016 ONEWORK</p>
    <p>通过建立云协作的组织，让人们相信远程办公是可行的，即使是在中国</p>
  </div>

  <div class="new-index-unit-b">
    <div class="new-index-unit-b-title">
      <p>远程工作</p>
      <p>推荐优秀远程人才</p>
    </div>
    <div class="new-index-unit-b-con">
      <div class="new-index-unit-b-con-left">
        <div class="title">最新项目</div>
        <div class="new-index-unit-b-list">
          <ul>
                 @if(isset($g_sideInfos[2]))
                            @foreach( $g_sideInfos[2] as $topic)
                                  <li>
                                      <a href="{{ route('topics.show', [$topic->id]) }}">{{$topic->title}}</a>
                                      <p><span>{{ $topic->user->username }}</span><span class="timeago">{{ $topic->created_at }}</span></p>
                                  </li>
                          @endforeach
                      @endif
            <li><a href="{{url('nodes/5')}}">更多...</a></li>
          </ul>
        </div>
      </div>
      <div class="new-index-unit-b-con-right">
        <div class="title">最新招聘</div>
        <div class="new-index-unit-b-list">
          <ul>
            @if(isset($g_sideInfos[1]))
                              @foreach( $g_sideInfos[1] as $topic)
                                  <li>
                                      <a href="{{ route('topics.show', [$topic->id]) }}">{{$topic->title}}</a>
                                      <p><span>{{ $topic->user->username }}</span><span class="timeago">{{ $topic->created_at }}</span></p>
                                  </li>
                              @endforeach
            @endif
            <li><a href="{{url('nodes/6')}}">更多...</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

    {{--<div class="new-index-unit-c">--}}
    @include('layouts.partials.footer')
      {{--</div>--}}
@stop
@section('scripts')
<script>
$(".footer").css("margin-top",0);
</script>
@stop