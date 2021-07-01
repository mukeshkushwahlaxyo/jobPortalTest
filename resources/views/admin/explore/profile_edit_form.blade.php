<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Designer Name', trans('Designer Name').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div class="input-group">
	      <input name="name" value="{{isset($profile) ? $profile->name :''}}" class="form-control" required>
	      <span class="input-group-addon" id="basic-addon1">
	        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
	      </span>
    	</div>
    	<div class="help-block with-errors"></div>  
  	</div>
</div>

<div class="row imageUpload ">
    <div class="col-md-4 nopadding-right">
     <input id="uploadFile" placeholder="{{ trans('Profile Picture') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-2 nopadding-left">
    <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }} </span>
        <input type="file" name="profile" id="uploadBtn" class="upload" />
    </div>
    </div>

    <div class="col-md-4 nopadding-right">
     <input id="uploadFile" placeholder="{{ trans('Cover Picture') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-2 nopadding-left">
    <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }} </span>
        <input type="file" name="cover" id="uploadBtn" class="upload" />
    </div>	
    </div>
</div>

<div class="row" style="margin-top:30px;">
	@if(isset($profile))
		@foreach($profile->images as $image)
			<div class="col-md-6">
				<div class="form-group">
				    @if(isset($image) && Storage::exists(optional($image)->path))
				      <label for="exampleInputFile"> {{ $image->type ==='cover'  ? trans('Cover Picture') : trans('Profile Picture') }}</label>      
				      <label>
				        <img src="{{ get_storage_file_url(optional($image)->path, 'small') }}" width="" alt="{{ trans('app.image') }}">
				        <span style="margin-left: 10px;">
				          {!! Form::checkbox($image->type ==='cover' ? 'cover_image':'profile_image', $image->id, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_pattern') }}
				        </span>
				      </label>
				      @endif	      
				</div>
			</div>
		@endforeach	
	@endif	
</div>

<div class="row">
	<div class="col-md-1 dividertxt">
		About
	</div>
	<div class="col-md-11">
		<hr>
	</div>
</div>	

<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Experience', trans('Experience').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div class="input-group">
	      <input name="exprience" value="{{isset($profile) ? $profile->exprience :''}}" class="form-control" required>
	      <span class="input-group-addon" id="basic-addon1">
	        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
	      </span>
    	</div>
    	<div class="help-block with-errors"></div>  
  	</div>
</div>

<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Experience Details/ Description ', trans('Experience Details/ Description ').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div >
	    	<textarea name='description' class="form-control" required>{{isset($profile) ? $profile->description:''}} </textarea>	      
	     
    	</div>
    	<div class="help-block with-errors"></div>  
  	</div>
</div>

<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Location', trans('Location').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div class="input-group">
	      <input name="location" value="{{isset($profile) ? $profile->location :''}}" class="form-control" required>
	      <span class="input-group-addon" id="basic-addon1">
	        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
	      </span>
    	</div>
    	<div class="help-block with-errors"></div>  
  	</div>
</div>

<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Last Delivery', trans('Last Delivery').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              {!! Form::text('lastdelivery', isset($profile) ?  $profile->lastdelivery : null, ['class' => 'form-control datetimepicker','required' ,'placeholder' => trans('app.placeholder.offer_start')]) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>
  	</div>
</div>
