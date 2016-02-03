
@if(!isset($project) or count($project)==0)

<div class="project-info">
  <div class="one-project">
    <p class="subtitle">
      项目经验
    </p>
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
      {{Form::text('ProjectUrl[ ]',null,array('placeholder'=>'展示链接'))}}
    </div>
    <div class="form-group has-feedback">
      {{Form::textarea('Projectexperience[ ]',null,['placeholder'=>'项目经历'])}}
    </div>
  </div>
</div>
@else
@for($i=0;$i<count($project);$i++)
<div class="project-info">
  <div class="one-project">

  @if($i>0)
  <p class="subtitle">项目经验<b></b></p>
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
  </div>
</div>
@endfor
@endif
