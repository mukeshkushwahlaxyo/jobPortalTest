<div class="form-group">
  {!! Form::label('attribute_id', trans('CATEGORY').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('catagory') }}"></i>
  <select name='category_id' class="form-control select2-normal" placeholder="Select" required>
  	<option></option>
  	@foreach($category as $Category)
  		<option {{isset($attributeValue) ? $attributeValue->category_id === $Category->id ? 'selected=selected':'' :''}} value={{$Category->id}}>{{$Category->name}}</option>
  	@endforeach	
  </select>
 
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('attribute_id', trans('app.form.attribute').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('catagory') }}"></i>
  <select name='attribute_id' class="form-control select2-normal attribute_id" placeholder="Select" required>
  	<option></option>
  	@foreach($attribute as $key => $Attribute)
  		<option   {{isset($attributeValue) ? $attributeValue->attribute_id === $Attribute->id ? 'selected=selected':'' :''}} value="{{$Attribute->id}}">{{$Attribute->name}}</option>
  	@endforeach	
  </select>
 
  <div class="help-block with-errors"></div>
</div>

<div class="form-group hidden sublist_container">
  {!! Form::label('attribute_id', trans('ATTRIBUTE SUBLIST').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('catagory') }}"></i>
  <select name='attribute_sublist_id' id='attribute_sublist_id' class="form-control select2-attribute_value-attribute" placeholder="Select" required>
  	
  </select>
 
  <div class="help-block with-errors"></div>
</div>



<div class="row">
  <div class="col-md-8 nopadding-right">
	<div class="form-group">
	  	{!! Form::label('value', trans('app.form.attribute_value').'*') !!}
		<div class="input-group">
			{!! Form::text('value', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.attribute_value'), 'required']) !!}
		    <span class="input-group-addon" id="basic-addon1">
		      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_value') }}"></i>
		    </span>
		 </div>
	  	<div class="help-block with-errors"></div>
	</div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('order', trans('app.form.list_order')) !!}
      <div class="input-group">
        {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.list_order')]) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.list_order') }}"></i>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div id="color-option" class=" {{isset($attributeValue) ? $attributeValue->color != null ? 'show':'hidden' :'hidden'}}" >

	<div class="form-group">
	  {!! Form::label('color', trans('app.form.color_attribute')) !!}
		<div class="input-group my-colorpicker2 colorpicker-element">
		  	{!! Form::text('color', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color')]) !!}
			<div class="input-group-addon">
				<i style="background-color: rgb(135, 60, 60);"></i>
			</div>
		</div>
	</div>

	
</div>

<div class="form-group">
	@if(isset($attributeValue) && Storage::exists(optional($attributeValue->image)->path))
	  <label for="exampleInputFile"> {{ trans('app.form.pattern') }}</label>	  
	  <label>
      	<img src="{{ get_storage_file_url(optional($attributeValue->image)->path, 'small') }}" width="" alt="{{ trans('app.image') }}">
	    <span style="margin-left: 10px;">
	      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_pattern') }}
	    </span>
	  </label>
	  @endif
	  
	</div>

<div class="row imageUpload hidden">
    <div class="col-md-9 nopadding-right">
     <input id="uploadFile" placeholder="{{ trans('app.placeholder.image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
    <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }} </span>
        <input type="file" name="image" id="uploadBtn" class="upload" />
    </div>
    </div>
	</div>

@if(Auth::user()->role->name =='Merchant')

	<div class="marchent hidden" style="margin-top: 22px;">
		<div class="row">
	  <div class="col-md-6 ">
			<div class="form-group">
			  	{!! Form::label('value', trans('Price').'*') !!}
				<div class="input-group">
					<input class="form-control" name="price" placeholder="Price" value="{{isset($attributeValue) ? $attributeValue->price :''}}" required>
				    <span class="input-group-addon" id="basic-addon1">
				      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_value') }}"></i>
				    </span>
				 </div>
			  	<div class="help-block with-errors"></div>
			</div>
	  </div>
	  <div class="col-md-6 ">
			<div class="form-group">
			  	{!! Form::label('value', trans('Quality').'*') !!}
				<div class="input-group">
					<input class="form-control" name="quality" placeholder="Quality" value="{{isset($attributeValue) ? $attributeValue->quality :''}}" required>
				    <span class="input-group-addon" id="basic-addon1">
				      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_value') }}"></i>
				    </span>
				 </div>
			  	<div class="help-block with-errors"></div>
			</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-md-6 ">
			<div class="form-group">
			  	{!! Form::label('value', trans('Quantity').'*') !!}
				<div class="input-group">
					<input class="form-control" name="quantity" placeholder="Quantity" value="{{isset($attributeValue) ? $attributeValue->quantity :''}}" required>
				    <span class="input-group-addon" id="basic-addon1">
				      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_value') }}"></i>
				    </span>
				 </div>
			  	<div class="help-block with-errors"></div>
			</div>
	  </div>
	  <div class="col-md-6">
			<div class="form-group">
			  	{!! Form::label('value', trans('Status').'*') !!}
				<div class="input-group">
						<select name='status' class="form-control select2-attribute_value-attribute" placeholder="Select" required>
	  						<option value="1">Active</option>
	  						<option value="0">Inactive</option>
	  				</select>
				    <span class="input-group-addon" id="basic-addon1">
				      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_value') }}"></i>
				    </span>
				 </div>
			  	<div class="help-block with-errors"></div>
			</div>
	  </div>
	</div>
		<div class="row mt-3" >
		  <div class="col-md-12 ">
				<div class="form-group">
				  	{!! Form::label('value', trans('Description').'*') !!}
					<div class="">
						<textarea class="form-control" name="description" required>{{isset($attributeValue) ? $attributeValue->description :''}}</textarea>
					 </div>
				  	<div class="help-block with-errors"></div>
				</div>
		  </div>
	 </div>
	</div> 
@endif	

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>


<script>
	function getSublist(id,selected=''){
		$.ajax({
            method:'get',
            url:'/admin/catalog/attributeValue/sublist/'+id,
            success:function(res){
            	console.log(res.sublist)
            	if(res.sublist.length > 0 || res.isCustom.product_type === 2){

            		if(res.sublist.length > 0){
		            	var html = ''
		              res.sublist.map((value,index)=>{
		              	if(value.id == selected){
		              	 	html +="<option  value='"+value.id+"'>"+value.name+"</option>"	
		              	 }
		              	 else{
		              	 	html +="<option selected=selected value='"+value.id+"'>"+value.name+"</option>"	
		              	 }
		              	
		              })
		              $('#attribute_sublist_id').html(html)
		              $('.sublist_container').removeClass('hidden')
		              $('.sublist_container').addClass('show')
		            }
		            else{
		            	$('.sublist_container').removeClass('show')
		              $('.sublist_container').addClass('hidden')
		            }
	              $('.imageUpload').removeClass('hidden')
	              $('.marchent').removeClass('hidden')
	              $('.imageUpload').addClass('show')
	              $('.marchent').addClass('show')
	            }
	            else{
	            	if(id !== '1'){
	            		$('.imageUpload').removeClass('show')	
	            		$('.imageUpload').addClass('hidden')
	            	}
	            	$('.sublist_container').removeClass('show')	            	
	            	$('.marchent').removeClass('show')	            	
	              $('.sublist_container').addClass('hidden')
	              $('.marchent').addClass('hidden')
	              
	            }
        		}
    		})
	}
	@if(isset($attributeValue))
		$(document).ready(function(){
				var id = {{isset($attributeValue) ? $attributeValue->attribute_id : ''}}
				{{-- var selected = {{isset($attributeValue) ? $attributeValue->attribute_sublist_id : ''}} --}}
				if(id === 1){
					$('.imageUpload').removeClass('hidden')
					$('.imageUpload').addClass('show')
				}
				getSublist(id)
		})
	@endif	
    
  $(document).on('change','.attribute_id',function(){
      var selected = $(this).val()
      if(selected === '1'){
      	$('#color-option').removeClass('hidden')
      	$('.imageUpload').removeClass('hidden')
        $('#color-option').addClass('show') 	
        $('.imageUpload').addClass('show') 	
      }
      else{
        	$('#color-option').removeClass('show')
        	$('.imageUpload').removeClass('show')
          $('#color-option').addClass('hidden')
          $('.imageUpload').addClass('hidden')
        }
      var id = $(this).val()
      getSublist(id)
      
  })
</script>