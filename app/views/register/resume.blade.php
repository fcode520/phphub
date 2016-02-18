 {{Form::open(array('url'=>'/EditResume/uploadimg','method' => 'POST','class'=>'content row','id'=>'uploadimgform'))}}

        <div class="header">
            @if($user->avatar)
                {{HTML::image($user->present()->gravatar,'a picture',array('class'=>'header form-group has-feedback','id'=>'user-avatar'))}}
            @else
                {{HTML::image(cdn('assets/images/register/addheader.png'),'a picture',array('class'=>'header form-group has-feedback','id'=>'user-avatar'))}}
            @endif
            {{Form::file('uploadImg',array('id'=>'uploadImg','onchange'=>'setImagePreview(\'header\',\'uploadImg\')'))}}
            <span id="upload-avatar">添加头像</span>
        </div>
{{Form::close()}}

{{Form::open(array('url'=>'/EditResume','class'=>'content row','id'=>'renzhengform','novalidate'=>'novalidate'))}}
        <div class="input">
<div class="form-group has-feedback clearfix">
        <span class="col-sm-4 col-xs-12">
                  {{Form::select('sex',[
                                      ''=>'性别',
                                      '0'=>'男',
                                      '1'=>'女',
                                      '2'=>'保密'])}}
           </span>
        <span class="col-sm-4 col-xs-12">
                {{Form::select('skill',$skills,isset($resume)?$resume->skill_id:0)}}
                </span>
        <span class="col-sm-4 col-xs-12">
               {{Form::select('profession',$professions,isset($resume)?$resume->remote_status:0)}}
                </span>
</div>
      @if(is_null($resume))
       <div class="form-group has-feedback">
       {{Form::text('qqnumber',null,array('placeholder'=>'QQ','id'=>'qq'))}}
       </div>
       <div class="form-group has-feedback">
       {{Form::text('Blog','',array('placeholder'=>'博客/github'))}}
       </div>
        @else
       <div class="form-group has-feedback">
       {{Form::text('qqnumber',$resume->qq,array('placeholder'=>'QQ','id'=>'qq'))}}
       </div>
       <div class="form-group has-feedback">
       {{Form::text('Blog',$resume->blog,array('placeholder'=>'博客/github'))}}
       </div>
        @endif
        <div class="form-group has-feedback clearfix distpicker" data-toggle="distpicker">
            <span class="col-sm-4 col-xs-12">{{Form::select('province')}}</span>
            <span class="col-sm-4 col-xs-12">{{Form::select('city')}}</span>
            <span class="col-sm-4 col-xs-12">{{Form::select('district')}}</span>
        </div>
        <div class="form-group has-feedback">
            {{Form::textarea('summery',isset($resum)?$resume->summary:null,['placeholder'=>'个人简介'])}}
        </div>
        <div class="form-group has-feedback">
            {{Form::textarea('experience',isset($resum)?$resume->skill_experience:null,['placeholder'=>'技术经验'])}}
        </div>
@include('register.OneProject')

</div>
     <p class="addjingyan">+添加一个项目经验</p>
{{Form::hidden('projectNum','1',array('id'=>'projectNum'))}}
{{Form::submit('保存',array('id'=>'mysubmit','class'=>'mysubmit'))}}
{{Form::close()}}
