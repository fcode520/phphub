<div class=" container">
@if(Session::get('message'))
<p>{{Session::get('message')}}</p>
@endif
<div class="container attestation">
  <p class="title"><span>完善资料</span><span>填写详细个人信息，加入人才库</span></p>


<div class="content row">

        {{Form::open(array('url'=>'/EditResume/uploadimg','method' => 'POST','class'=>' form-group has-feedback','id'=>'uploadimgform'))}}
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


{{Form::open(array('url'=>'/account/EditResume','class'=>'editresume','id'=>'renzhengform','novalidate'=>'novalidate'))}}

    <div class="input">
     <div class="form-group has-feedback">
        <input type="text" name="email" id="" placeholder="邮箱">
     </div>
      @if(is_null($resume))
    <div class="form-group has-feedback clearfix">
        <span class="col-sm-4 col-xs-12">
         {{Form::select('sex',[
                                         ''=>'性别',
                                         '0'=>'男',
                                         '1'=>'女',
                                         '2'=>'保密'])}}
        </span>
        <span class="col-sm-4 col-xs-12">
          {{Form::select('skill',$skills)}}
        </span>
        <span class="col-sm-4 col-xs-12">
          {{Form::select('profession',[
                                          ''=>'职业',
                                          '0'=>'全职远程工作者1',
                                          '1'=>'兼职远程工作者',
                                          '2'=>'非远程工作者'])}}
        </span>
      </div>

  <div class="form-group has-feedback">
          {{--<input type="tel" name="qqnumber" id="" placeholder="QQ">--}}
          {{Form::text('qqnumber',null,array('placeholder'=>'QQ','id'=>'qq'))}}
           {{Form::text('Blog','',array('placeholder'=>'博客/github'))}}
      </div>
      @else
<div class="form-group has-feedback clearfix">
        <span class="col-sm-4 col-xs-12">
          {{Form::select('sex',[
                                         ''=>'性别',
                                         '0'=>'男',
                                         '1'=>'女',
                                         '2'=>'保密'],$resume->sex)}}
        </span>
        <span class="col-sm-4 col-xs-12">
           {{Form::select('skill',[
                                          ''=>'主要技能',
                                          '0'=>'C++',
                                          '1'=>'PHP',
                                          '2'=>'ios',
                                          '3'=>'Andriod',
                                          '4'=>'web前端'
                                          ],$resume->skill_id)}}
        </span>
        <span class="col-sm-4 col-xs-12">
          {{Form::select('profession',[
                                          ''=>'职业',
                                          '0'=>'全职远程工作者',
                                          '1'=>'兼职远程工作者',
                                          '2'=>'非远程工作者'],$resume->remote_status)}}
        </span>
      </div>
  <div class="form-group has-feedback">
                            {{Form::text('qqnumber',$resume->qq,array('placeholder'=>'QQ','id'=>'qq'))}}
                            {{Form::text('Blog',$resume->blog,array('placeholder'=>'博客/github'))}}
  </div>
      @endif



      <div id="distpicker"  class="form-group has-feedback clearfix" data-toggle="distpicker">
      <span class="col-sm-4 col-xs-12">{{Form::select('province')}}</span>
      <span class="col-sm-4 col-xs-12">{{Form::select('city')}}</span>
      <span class="col-sm-4 col-xs-12">{{Form::select('district')}}</span>
      </div>

      @if(!isset($resume))
                                 <div class="form-group has-feedback"> {{Form::textarea('summery',null,['placeholder'=>'个人简介'])}}</div>
                                  <div class="form-group has-feedback">{{Form::textarea('experience',null,['placeholder'=>'技术经验'])}}</div>
                                  @else
                                  <div class="form-group has-feedback">{{Form::textarea('summery',$resume->summary,['placeholder'=>'个人简介'])}}</div>
                                  <div class="form-group has-feedback">{{Form::textarea('experience',$resume->skill_experience,['placeholder'=>'技术经验'])}}</div>
      @endif

      <div class="project-info">
            @if(!isset($project) or count($project)==0)
        <div class="one-project">
          <p class="subtitle">项目经验</p>
          <div class=" clearfix">
            <span class="col-sm-6 col-xs-12 form-group has-feedback">
              {{Form::text('ProjectName[ ]',null,array('placeholder'=>'项目名称'))}}
            </span>
            <span class="col-sm-6 col-xs-12 form-group has-feedback">
              {{Form::text('ProjectPosition[ ]',null,array('placeholder'=>'担任职务'))}}
            </span>
          </div>
          <div class="form-group has-feedback clearfix">
            <span class="col-sm-6 col-xs-12">
            {{Form::text('starttime[ ]',null,array('id'=>'starttime_id','class'=>'timeclass','data-position'=>'bottom'))}}

            </span>
            <span class="col-sm-6 col-xs-12">
            {{Form::text('endtime[ ]',null,array('id'=>'endtime_id','class'=>'timeclass','data-position'=>'bottom'))}}
            </span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="zhanshi" id="" placeholder="展示链接">
            {{Form::text('ProjectUrl[ ]',null,array('placeholder'=>'展示链接'))}}
          </div>
          <div class="form-group has-feedback">
            <textarea name="xiangmujingli" id="" placeholder="项目经历"></textarea>
            {{Form::textarea('Projectexperience[ ]',null,['placeholder'=>'项目经历'])}}
          </div>

        </div>

@else
        @for($i=0;$i<count($project);$i++)
        <div class="one-project">
        @if($i>0)
        <p class="subtitle">项目经验<span></span></p>
        @else
        <p class="subtitle">项目经验</p>
        @endif
                  <div class=" clearfix">
                    <span class="col-sm-6 col-xs-12 form-group has-feedback">
                        {{Form::text('ProjectName[ ]',$project[$i]->project_name,array('placeholder'=>'项目名称'))}}
                    </span>
                    <span class="col-sm-6 col-xs-12 form-group has-feedback">
                        {{Form::text('ProjectPosition[ ]',$project[$i]->role,array('placeholder'=>'担任职务'))}}
                    </span>
                  </div>
                  <div class="form-group has-feedback clearfix">
                    <span class="col-sm-6 col-xs-12">
                    {{Form::text('starttime[ ]',$project[$i]->start_time,array('id'=>'starttime_id','class'=>'timeclass','data-position'=>'bottom'))}}

                    </span>
                    <span class="col-sm-6 col-xs-12">
                     {{Form::text('endtime[ ]',$project[$i]->end_time,array('id'=>'endtime_id','class'=>'timeclass','data-position'=>'bottom'))}}
                    </span>
                  </div>
                  <div class="form-group has-feedback">
                {{Form::text('ProjectUrl[ ]',$project[$i]->url,array('placeholder'=>'展示链接'))}}
                  </div>
                  <div class="form-group has-feedback">
                    {{Form::textarea('Projectexperience[ ]',$project[$i]->description,['placeholder'=>'项目经历'])}}
                  </div>
        @endfor
@endif
      <p class="addjingyan">+添加一个项目经验</p>
      {{Form::hidden('projectNum','1',array('id'=>'projectNum'))}}
      {{Form::submit('保存',array('id'=>'resumesubmit','class'=>'resumesubmit'))}}
    </div>
  {{Form::close()}}
  </div>
</div>
</div>
</div>

