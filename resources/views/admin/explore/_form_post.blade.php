<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Title Of Post', trans('Title Of Post').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div class="input-group">
	      <input name="title" value="{{isset($post) ? $post->title :''}}" class="form-control" required>
	      <span class="input-group-addon" id="basic-addon1">
	        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
	      </span>
    	</div>
    	<div class="help-block with-errors"></div>  
  	</div>
</div>

<div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">
    	{!! Form::label('Description', trans('Description').'*', ['class' => 'with-help']) !!}
    </div>
    
   <div class="col-md-12 field_wrapper" style="margin-top:10px;">
	    <div class="input-group">
	      <textarea name="description" class="form-control post_desc" required>{{isset($post) ? $post->description :''}}</textarea>	      
    	</div>
    	<div class="help-block with-errors"></div>  
  	</div>
</div>

<div class="form-group">
    @if(isset($post) && Storage::exists(optional($post->image)->path))
      <label for="exampleInputFile"> {{ trans('app.form.pattern') }}</label>      
      <label>
        <img src="{{ get_storage_file_url(optional($post->image)->path, 'small') }}" width="" alt="{{ trans('app.image') }}">
        <span style="margin-left: 10px;">
          {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_pattern') }}
        </span>
      </label>
      @endif
      
</div>

<div class="row imageUpload ">
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

<div class="row">
    <div class=" col-md-12" style="margin-top:20px;">
        <a id="tagButton" >Add<i style="margin-left: 5px;" class="fa fa-plus"></i></a>
    </div>
</div>

<div class="sublist_parent row {{isset($post->category) && isset($post->product) ?  'show':'hidden'}}" id ="categoryPost" style="margin-top: 20px;">
    @if(isset($post->category))
        <script>
            getProductByCategory({{$post->category->id}},{{$post->product->id}})
        </script>
    @endif
    <div class="col-md-12 field_wrapper" style="margin-top:10px;">
         {!! Form::label('Category', trans('Category').'*', ['class' => 'with-help']) !!}
        <div class="">
          <select name="category_id" id='caterory_id' class="form-control select2-normal " placeholder="Select" >
            <option></option>
            @foreach($category as $key => $cat)
                <option {{ isset($post->product) ? $post->category->id === $cat->id ? 'selected' : '':''}} value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach 
          </select>
        </div>
        <div class="help-block with-errors"></div>  
    </div>
    <div class="col-md-12">
       {!! Form::label('Product', trans('Product').'*', ['class' => 'with-help']) !!}
        <div >
          <select id="product_id" name='product_id' class="form-control select2-normal " placeholder="Select" >
            <option></option>
            
          </select>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>
