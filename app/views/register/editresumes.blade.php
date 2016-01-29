<div class="my-article">
    <div class="container">
        <div class="row">
            <div class="col-xs-9 modify-article message-center">
                <h2 class="title">Message center｜个人设置</h2>

                <div class="clearfix"></div>
                <ul class="personal-nav">
                    <li class="act">个人资料</li>
                    <li><a href="{{route('EditResume')}}">修改资料</a></li>
                    <li><a>修改密码</a></li>
                </ul>

                <div class="clearfix"></div>
                <div class="personal-infomation">
                    <div class="renzheng">
                    {{Form::open(array('url'=>'/EditResume/uploadimg','method' => 'POST','class'=>'content','id'=>'uploadimgform'))}}

                    <div class="header">
                        @if(isset($user->avatar))
                            {{HTML::image($user->present()->gravatar,'a picture',array('class'=>'header','id'=>'user-avatar','style'=>'width:38px;height:38px;'))}}
                        @else
                            {{HTML::image(cdn('assets/images/register/addheader.png'),'a picture',array('class'=>'header','id'=>'user-avatar','style'=>'width:38px;height:38px;'))}}
                        @endif
                        {{Form::file('uploadImg',array('id'=>'uploadImg','onchange'=>'setImagePreview(\'header\',\'uploadImg\')'))}}
                        <span id="upload-avatar">添加头像</span>
                    </div>
                    {{Form::close()}}

                    {{Form::open(array('url'=>'/account/EditResume','class'=>'content','id'=>'renzhengform'))}}
                    <div class="input">
                        {{--<input type="text" name="email" id="" placeholder="邮箱">--}}

                        @if(is_null($resume))
                            <div class="row">
                                {{Form::select('sex',[
                                ''=>'性别',
                                '0'=>'男',
                                '1'=>'女',
                                '2'=>'保密'])}}

                                {{Form::select('skill',[
                               ''=>'技能',
                               '0'=>'C++',
                               '1'=>'PHP',
                               '2'=>'ios',
                               '3'=>'Andriod',
                               '4'=>'web前端'
                               ])}}
                                {{Form::select('profession',[
                               ''=>'职业',
                               '0'=>'全职远程工作者',
                               '1'=>'兼职远程工作者',
                               '2'=>'非远程工作者'])}}

                            </div>
                            {{Form::text('qqnumber',null,array('placeholder'=>'QQ','id'=>'qq'))}}
                            {{Form::text('Blog','',array('placeholder'=>'博客/github'))}}

                        @else
                            <div class="row">
                                {{Form::select('sex',[
                                ''=>'性别',
                                '0'=>'男',
                                '1'=>'女',
                                '2'=>'保密'],$resume->sex)}}

                                {{Form::select('skill',[
                               ''=>'技能',
                               '0'=>'C++',
                               '1'=>'PHP',
                               '2'=>'ios',
                               '3'=>'Andriod',
                               '4'=>'web前端'
                               ],$resume->skill_id)}}
                                {{Form::select('profession',[
                               ''=>'职业',
                               '0'=>'全职远程工作者',
                               '1'=>'兼职远程工作者',
                               '2'=>'非远程工作者'],$resume->remote_status)}}

                            </div>
                            {{Form::text('qqnumber',$resume->qq,array('placeholder'=>'QQ','id'=>'qq'))}}
                            {{Form::text('Blog',$resume->blog,array('placeholder'=>'博客/github'))}}
                        @endif



                        <div id="distpicker" class="row" data-toggle="distpicker">
                            {{Form::select('province')}}
                            {{Form::select('city')}}
                            {{Form::select('district')}}
                        </div>
                        @if(!isset($resume))
                            {{Form::textarea('summery',null,['placeholder'=>'个人简介'])}}
                            {{Form::textarea('experience',null,['placeholder'=>'技术经验'])}}
                        @else
                            {{Form::textarea('summery',$resume->summary,['placeholder'=>'个人简介'])}}
                            {{Form::textarea('experience',$resume->skill_experience,['placeholder'=>'技术经验'])}}
                        @endif
                        <div class="project-info">
                            @if(!isset($project) or count($project)==0)
                                <div class="one-project">
                                    <p class="subtitle">项目经验</p>
                                    <div class="row2">
                                        {{Form::text('ProjectName[ ]',null,array('placeholder'=>'项目名称'))}}
                                        {{Form::text('ProjectPosition[ ]',null,array('placeholder'=>'担任职务'))}}
                                    </div>
                                    <div class="row2">
                                        {{Form::text('starttime[ ]',null,array('id'=>'starttime_id','class'=>'timeclass','data-position'=>'bottom'))}}
                                        {{Form::text('endtime[ ]',null,array('id'=>'endtime_id','class'=>'timeclass','data-position'=>'bottom'))}}

                                    </div>
                                    {{Form::text('ProjectUrl[ ]',null,array('placeholder'=>'展示链接'))}}
                                    {{Form::textarea('Projectexperience[ ]',null,['placeholder'=>'项目经历'])}}
                                </div>
                            @else

                                @for($i=0;$i<count($project);$i++)
                                    <div class="one-project">
                                        @if($i>0)
                                            <p class="subtitle">项目经验<span></span></p>
                                        @else
                                            <p class="subtitle">项目经验</p>
                                        @endif
                                        <div class="row2">
                                            {{Form::text('ProjectName[ ]',$project[$i]->project_name,array('placeholder'=>'项目名称'))}}
                                            {{Form::text('ProjectPosition[ ]',$project[$i]->role,array('placeholder'=>'担任职务'))}}
                                        </div>
                                        <div class="row2">
                                            {{Form::text('starttime[ ]',$project[$i]->start_time,array('id'=>'starttime_id','class'=>'timeclass','data-position'=>'bottom'))}}
                                            {{Form::text('endtime[ ]',$project[$i]->end_time,array('id'=>'endtime_id','class'=>'timeclass','data-position'=>'bottom'))}}

                                        </div>
                                        {{Form::text('ProjectUrl[ ]',$project[$i]->url,array('placeholder'=>'展示链接'))}}
                                        {{Form::textarea('Projectexperience[ ]',$project[$i]->description,['placeholder'=>'项目经历'])}}
                                    </div>

                                @endfor
                            @endif
                        </div>

                        <p class="addjingyan">+添加一个项目经验</p>
                        {{Form::hidden('projectNum','1',array('id'=>'projectNum'))}}
                        {{Form::submit('保存',array('id'=>'mysubmit','class'=>'mysubmit'))}}
                    </div>
                    {{Form::close()}}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
