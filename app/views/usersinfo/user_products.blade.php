<div class="exchange-hot new-personal-center">
        <h2 class="title">项目</h2>
    @if(isset($resume)&& count($resume->userproject)>0)

        <ul>
    @foreach($resume->userproject as $product)
          <li>
            <div class="row">
              <div class="new-personal-pro-left col-xs-2">
                <p>0</p>
                <p>赞</p>
              </div>
              <div class="new-personal-pro-right col-xs-10">
                <p><a href="{{$product->url}}">{{$product->project_name}}</a></p>
                <p>{{$product->description}}</p>
                <p><span>{{$product->role}}</span></p>
              </div>
            </div>
          </li>
    @endforeach

        </ul>
    @else

        <div class="new-personal-center-con">
            {{'无项目'}}
        </div>
    @endif
</div>