<div class=" col-sm-9">
    <div class="clearfix"></div>
    @include('account.partials.TopSettingNav')
    <div class="clearfix"></div>

    <div class="container attestation">
        <p class="title"><span>完善资料</span>
            @if(Session::get('message'))
                <span>{{Session::get('message')}}</span>
            @else
                <span>完善个人资料，让更多人认识你！</span>
            @endif
        </p>


        <div class="content row">
            {{Form::open(array('url'=>'/account/EditResume','class'=>'editresume','id'=>'renzhengform','novalidate'=>'novalidate'))}}

            <div class="input">
                @if(is_null($resume))
                    <div class="form-group has-feedback clearfix">
                        {{Form::text('Real_name',null,array('placeholder'=>'真实姓名','id'=>'Real_name'))}}
                    </div>
                    <div class="form-group has-feedback clearfix">

                <span class="col-sm-3 col-xs-12">
                {{Form::select('sex',[
                                             ''=>'性别',
                                             '0'=>'男',
                                             '1'=>'女',
                                             '2'=>'保密'])}}
                </span>
            <span class="col-sm-3 col-xs-12">
            <select name="skill" data-bv-field="skill">
                <option value="" selected="selected">职业</option>
                <?php $skillIndex = 1; ?>
                @foreach($skills as $skill)
                    <option value="{{$skillIndex++}}">{{$skill}}</option>
                @endforeach
            </select>
                {{--{{Form::select('skill',$skills)}}--}}

            </span>

            <span class="col-sm-3 col-xs-12">
              {{Form::select('profession',[
                                              ''=>'远程类型',
                                              '0'=>'全职远程工作者',
                                              '1'=>'兼职远程工作者',
                                              '2'=>'非远程工作者'])}}
            </span>
                                     <span class="col-sm-3 col-xs-12">
              {{Form::select('work_experience',[
                                              ''=>'工作经验',
                                              '0'=>'0年',
                                              '1'=>'1年',
                                              '2'=>'2年',
                                              '3'=>'3年',
                                              '4'=>'4年',
                                              '5'=>'5年',
                                              '6'=>'6年',
                                              '7'=>'7年',
                                              '8'=>'8年',
                                              '9'=>'9年',
                                              '10'=>'10年',
                                              '11'=>'10年以上',
                                              ])}}
            </span>
                    </div>

                    <div class="form-group has-feedback">
                        {{Form::text('qqnumber',null,array('placeholder'=>'QQ','id'=>'qq'))}}
                        {{Form::text('Blog','',array('placeholder'=>'博客/github'))}}

                    </div>
                @else
                    <div class="form-group has-feedback clearfix">
                        {{Form::text('Real_name',$resume->real_name,array('placeholder'=>'真实姓名','id'=>'Real_name'))}}
                    </div>
                    <div class="form-group has-feedback clearfix">

            <span class="col-sm-3 col-xs-12">
              {{Form::select('sex',[
                                             ''=>'性别',
                                             '0'=>'男',
                                             '1'=>'女',
                                             '2'=>'保密'],$resume->sex)}}
            </span>
            <span class="col-sm-3 col-xs-12">

                                              <select name="skill" data-bv-field="skill">
                                                  <option value="" selected="selected">职业</option>
                                                  <?php $skillIndex = 1; ?>
                                                  @foreach($skills as $skill)
                                                      @if($skillIndex==$resume->skill_id)
                                                          <option value="{{$skillIndex++}}"
                                                                  selected="selected">{{$skill}}</option>
                                                      @else
                                                          <option value="{{$skillIndex++}}">{{$skill}}</option>
                                                      @endif

                                                  @endforeach
                                              </select>

            </span>
            <span class="col-sm-3 col-xs-12">
              {{Form::select('profession',[
                                              ''=>'远程类型',
                                              '0'=>'全职远程工作者',
                                              '1'=>'兼职远程工作者',
                                              '2'=>'非远程工作者'],$resume->remote_status)}}
            </span>
             <span class="col-sm-3 col-xs-12">
              {{Form::select('work_experience',[
                                              ''=>'工作经验',
                                              '0'=>'0年',
                                              '1'=>'1年',
                                              '2'=>'2年',
                                              '3'=>'3年',
                                              '4'=>'4年',
                                              '5'=>'5年',
                                              '6'=>'6年',
                                              '7'=>'7年',
                                              '8'=>'8年',
                                              '9'=>'9年',
                                              '10'=>'10年',
                                              '11'=>'10年以上',
                                              ],$resume->work_experience)}}
            </span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::text('qqnumber',$resume->qq,array('placeholder'=>'QQ','id'=>'qq'))}}
                        {{Form::text('Blog',$resume->blog,array('placeholder'=>'博客/github'))}}
                    </div>
                @endif


                <div id="distpicker" class="form-group has-feedback clearfix" data-toggle="distpicker">
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
            {{Form::text('starttime[ ]',null,array('readonly'=>"readonly",'placeholder'=>'1988-01-01','id'=>'starttime_id','class'=>'timeclass','data-position'=>'bottom'))}}

            </span>
            <span class="col-sm-6 col-xs-12">
            {{Form::text('endtime[ ]',null,array('readonly'=>"readonly",'placeholder'=>'1988-01-01','id'=>'endtime_id','class'=>'timeclass','data-position'=>'bottom'))}}
            </span>
<<<<<<< HEAD
                            </div>
                            <div class="form-group has-feedback">
                                {{--<input type="text" name="zhanshi" id="" placeholder="展示链接">--}}
                                {{Form::text('ProjectUrl[ ]',null,array('placeholder'=>'展示链接 http://'))}}
                            </div>
                            <div class="form-group has-feedback">
                                {{--<textarea name="xiangmujingli" id="" placeholder="项目经历"></textarea>--}}
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
=======
          </div>
          <div class="form-group has-feedback">
            {{--<input type="text" name="zhanshi" id="" placeholder="展示链接">--}}
            {{Form::text('ProjectUrl[ ]',null,array('placeholder'=>'展示链接 http://'))}}
          </div>
          <div class="form-group has-feedback">
            {{--<textarea name="xiangmujingli" id="" placeholder="项目经历"></textarea>--}}
            {{Form::textarea('Projectexperience[ ]',null,['placeholder'=>'项目描述'])}}
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
>>>>>>> b346cf6f20e7cea4b6f33b2020a52dd785f5b786
                    <span class="col-sm-6 col-xs-12 form-group has-feedback">
                        {{Form::text('ProjectName[ ]',$project[$i]->project_name,array('placeholder'=>'项目名称'))}}
                    </span>
                    <span class="col-sm-6 col-xs-12 form-group has-feedback">
                        {{Form::text('ProjectPosition[ ]',$project[$i]->role,array('placeholder'=>'担任职务'))}}
                    </span>
                                </div>
                                <div class="form-group has-feedback clearfix">
                    <span class="col-sm-6 col-xs-12">
                    {{Form::text('starttime[ ]',$project[$i]->start_time,array('readonly'=>"readonly",'id'=>'starttime_id','class'=>'timeclass','data-position'=>'bottom'))}}

                    </span>
                    <span class="col-sm-6 col-xs-12">
                     {{Form::text('endtime[ ]',$project[$i]->end_time,array('readonly'=>"readonly",'id'=>'endtime_id','class'=>'timeclass','data-position'=>'bottom'))}}
                    </span>
                                </div>
                                <div class="form-group has-feedback">
                                    {{Form::text('ProjectUrl[ ]',$project[$i]->url,array('placeholder'=>'展示链接 http://'))}}
                                </div>
                                <div class="form-group has-feedback">
                                    {{Form::textarea('Projectexperience[ ]',$project[$i]->description,['placeholder'=>'项目经历'])}}
                                </div>
                            </div>
                        @endfor
                    @endif

                </div>

            </div>
            <p class="addjingyan">+添加一个项目经验</p>
            {{Form::hidden('projectNum','1',array('id'=>'projectNum'))}}
            {{Form::submit('保存',array('id'=>'resumesubmit','class'=>'resumesubmit'))}}
            {{Form::close()}}
        </div>
    </div>
</div>
</div>