      <div class="exchange-hot new-personal-center">
        <h2 class="title">个人简介：</h2>
        <div class="new-personal-center-con">
        @if(isset($resume))
            <p>{{$resume->summary}}</p>
            @else
            {{'尚未完善资料'}}
        @endif
       </div>
      </div>