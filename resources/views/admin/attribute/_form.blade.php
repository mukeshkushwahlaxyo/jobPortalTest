<div class="form-group">
  {!! Form::label('product type', trans('product type').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_type') }}"></i>
  <select id="product_type" name='product_type' placeholder = "{{trans('product type')}}" class="form-control select2-normal" required>  
      <option selected="selected" disabled="disabled" value="">Select</option>  
    @foreach($productType as $type)
      <option {{isset($attribute) ? $attribute->product_type === $type->id ? 'selected' :'' : ''}} value="{{$type->id}}">{{$type->name}}</option>
    @endforeach
  </select>
  <div class="help-block with-errors"></div>
</div>

{{--Custom attribute field  --}}

<div class="form-group custom_attr_field">
  
  {!! Form::label('attribute_type_id', trans('app.form.attribute_type').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_type') }}"><span class="isLoading text-danger ml-2"></span></i>
  <select id="attribute_type_id"  name='attribute_type_id' placeholder = "{{trans('product type')}}" class="form-control select2-normal" required>
      <option selected="selected" disabled="disabled" value="">Select</option>
  </select>
  <div class="help-block with-errors"></div>
</div>

<div class="sublist_wrap" style="display:none;">
  <div class="row">
    <div  class="col-md-12 text-right">
      <a id="add_sublist" class="btn btn-default">add</a>
    </div >
    
  </div>

  <div class="sublist_parent row" style="margin-bottom: 20px;">
    <div class="col-md-12">{!! Form::label('Attribute Sublist', trans('Attribute Sublist').'*', ['class' => 'with-help']) !!}</div>
    
    <?php $count  = 1; ?>
    @if(isset($attribute))
        @foreach($attribute->attributeSublist as $sublist)
          <div class="col-md-6 mt-3" id="multi_rows_{{$count}}" style="margin-top:10px;">
            <div class="input-group">
              <input class="form-control" value="{{$sublist->name}}" name="sublist_items[]" required>
              <span class="input-group-addon {{$count !== 1 ? 'delete_reco':''}}" data-id="{{$count}}" id="basic-addon1">
                <a style="width:100%;" >
                  <i class="fa {{$count === 1 ? 'fa-question-circle':'fa-minus text-danger'}} "  data-toggle="tooltip" data-placement="top"></i>
                </a>
              </span>
            </div>
          </div>
          <?php $count++; ?>
        @endforeach  
    @else
      <div class="col-md-6 field_wrapper" style="margin-top:10px;">
        <div class="input-group">
          <input name="sublist_items[]" class="form-control" required>
          <span class="input-group-addon" id="basic-addon1">
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"></i>
          </span>
        </div>
        <div class="help-block with-errors"></div>  
      </div>
    @endif
  </div>
</div>
{{--end Custom attribute field --}}


<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.attribute_name').'*') !!}
      <div class="input-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.attribute_name'), 'required']) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_name') }}"></i>
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

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>

<script>


  function getproductType(id,selected=''){
    $.ajax({
      method:'get',
      url:'/admin/catalog/attribute/getAttributeById/'+id+'/'+selected,
      beforeSend: function() {
        $('.isLoading').text('loading...');
      },
      success:function(res){
        $('#attribute_type_id').html(res)
        $('.isLoading').text('');
      }
    })
  }


  @if(isset($attribute))
    $(document).ready(function(){
      var id = {{isset($attribute) ? $attribute->product_type : 0 }}
      var selected = {{isset($attribute) ? $attribute->attribute_type_id: 0 }}
      var showFiels = {{isset($attribute) ? count($attribute->attributeSublist) !=0  ? 'true': 'false' :'false'}}
      alert(typeof showFiels)  
      if(showFiels){

         $('.sublist_wrap').css('display','inline'); 
      }
      getproductType(id,selected)    
    })  
  @endif  
  $(document).on('change','#product_type',function(){
      var id = $(this).val()
      getproductType(id)
  })



  $(document).on('change','#attribute_type_id ',function(){
      var attribute  = $('#select2-attribute_type_id-container').attr('title')
      if(attribute === 'Sublist'){
         $('.sublist_wrap').css('display','inline'); 
      }
      else{
        $('.sublist_wrap').css('display','none');
      }
  })


  $(document).ready(function(){
      var maxField = 11;      
      var wrapper = $('.sublist_parent');      
      var crut =$(".sublist_parent > div").length;
      var x = 1;
      if(crut !=0 ){
        x = crut;
      } 
          
      $('#add_sublist').click(function(){   
          if(x < maxField){ 
              x++; 

               var fieldHTML = '<div class="col-md-6 mt-3" id="multi_rows_'+x+'" style="margin-top:10px;"><div class="input-group"><input class="form-control" name="sublist_items[]" required><span class="input-group-addon remove_button" data-id="'+x+'" id="basic-addon1"><a style="width:100%;" ><i class="fa fa-minus text-danger" data-toggle="tooltip" data-placement="top"></i></a></span></div></div>'; 

              $(wrapper).append(fieldHTML);
          }
      });
      
      $(document).on('click', '.remove_button', function(e){
          e.preventDefault();

          var id = $(this).attr('data-id');

          $('#multi_rows_'+id).remove();
          //$('#'+id).remove();        
          x--;
      });
     
    })

  $(document).on('click','.delete_reco',function(){
    var id = $(this).attr('data-id')
    $('#multi_rows_'+id).remove();
    
  })

</script>