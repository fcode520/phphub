
 <div class="col-xs-9 ">
@if(isset($resume))
                    @include('account.partials.TopSettingNav')


                    <div class="clearfix"></div>

                    <div class="personal-infomation">
                        <div class="text-left">
                            <img class="" alt="{{$resume->user->username}}"
                                 src="{{ $resume->user->present()->gravatar }}"  style="width:38px;height:38px;"/>

                        </div>
                        <di class="a row">
                            <p><span class="col-sm-6"><label>邮箱</label>：{{$resume->user->email}}</span class="col-sm-6"><span class="col-sm-6"><label>性别</label>：男</span></p>
                            <p><span class="col-sm-6"><label>所在地</label>：{{$resume->position}}</span><span class="col-sm-6"><label>是否远程</label>：{{$resume->remote_status==2?"否":"是"}}</span></p>

                            <p><span class="col-sm-6"><label>远程类型</label>：
                                    @if($resume->remote_status==2)
                                        {{"非远程工作者"}}
                                    @else
                                        {{$resume->remote_status==0?"全职远程工作者":"兼职远程工作者"}}
                                    @endif
                                </span>


                                <span class="col-sm-6"><label>注册时间</label>：{{$resume->user->created_at}}</span></p>

                            <p><span class="col-sm-6"><label>QQ</label>：{{$resume->qq}}</span><span class="col-sm-6"><label>工作技能</label>：C++工程师</span></p>
                        </di>
                        <div class="clearfix"></div>
                        <div class="b">
                            <p><label>个人简介：</label><span>{{$resume->summary}}</span></p>
                            <p><label>技术经验：</label><span>{{$resume->skill_experience}}</span></p>
                            @if(count($resume->userproject))
                                <ul>
                                    @foreach($resume->userproject as $project)
                                        <li>
                                            <p><label>项目名称：</label><span>{{$project->project_name}}</span></p>
                                            <p><label>担任职位：</label><span>{{$project->role}}</span></p>
                                            <p><label>项目时间：</label><span>{{$project->start_time .'&nbsp;&nbsp;'.$project->end_time}}</span></p>
                                            <p><label>项目连接：</label><span><a href="{{$project->url}}">{{$project->url}}</a></span></p>
                                            <p><label>项目详情：</label><span>{{$project->description}}</span></p>
                                        </li>

                                    @endforeach
                                </ul>

                            @else

                                <ul>
                                    <li>
                                        <p><label>项目名称：</label><span> </span></p>
                                        <p><label>担任职位：</label><span> </span></p>
                                        <p><label>担任职位：</label><span> </span></p>
                                        <p><label>项目详情：</label><span> </span></p>
                                    </li>
                                </ul>
                            @endif
                        </div>
                        <p class="d">您的个人信息不会透露给任何第三方，请放心填写。</p>
                        <div class="c">
                            <p><label>姓名：</label><span>张磊</span></p>
                            <p><label>身份证号：</label><span>128291294129</span></p>
                            <p><label>手机号：</label><span>127123687</span></p>
                            <p><label>微信号：</label><span>xijois</span></p>
                        </div>
                    </div>
@endif
</div>
