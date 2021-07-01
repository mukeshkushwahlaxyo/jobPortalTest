@php
 $array = [];
  if(isset($inventory)){
      $attrID = getAttributeIds($inventory);
      $variant = getVariant($inventory->id);
     
      foreach($variant as $Variant){
        $attrids = getSelectedVariantAttrValue($Variant->id);
        foreach($attrids as $attrIDs => $attrIdVal){
          $array[$attrIDs][] = (string)$attrIdVal;
        }

      }   
  }
@endphp  

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ isset($inventory) ? trans('app.update_inventory') : trans('app.add_inventory') }}</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        @include('admin.partials._product_widget')
          <div>
            <div class="row">   
              <div class="col-sm-12 col-md-12">       
                <ul class="nav nav-tabs mb-4" >
                  <li class="nav-item " >
                    <a class="nav-link active show_vitalInfo" targetID='vital_information' href="#" aria-current="page" >Vital Information</a>
                  </li>
                  @if($product->has_variant)
                    <li class="nav-item ">
                      <a class="nav-link show_vitalInfo" targetID='veriant' href="#">Variant</a>
                      <input type="hidden" id="variantEditData" data-array="{{json_encode($array)}}">
                    </li>
                  @endif 
                  @if($product->isCustomise ) 
                    <li class="nav-item ">
                      <a class="nav-link show_customise_property" targetID='customise_property' href="#">Customise Property</a>
                      <input type="hidden" id="CustomiseIds" data-value="{{isset($attrID) ?  $attrID : ''}}">
                    </li>
                  @endif  
                  
                </ul>
              </div>
            </div>
            @php
              if( isset($inventory) ) {
                $product = $inventory->product;
              }

              $requires_shipping = $product->requires_shipping || (isset($inventory) && $inventory->product->requires_shipping);

              $title_classes = isset($inventory) ? 'form-control' : 'form-control makeSlug';
            @endphp

            {{ Form::hidden('product_id', $product->id) }}
            {{ Form::hidden('brand', $product->brand) }}
            <div class="hidden customise_property">
              @include('admin.inventory._customise')
            </div> 

              <div class="hidden veriant">
                <div>
                  @include('admin.inventory._set_variant')
                </div>
              </div>
            </div>
              @if(isset($inventory))
                {!! Form::model($inventory, ['method' => 'POST', 'route' => ['admin.stock.inventory.update', $inventory->id], 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
              @else  
                {!! Form::open(['route' => 'admin.stock.inventory.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
              @endif  
              <div class="vital_information">
                @include('admin.inventory._vitalInformation')
              </div>
            {!! Form::close() !!}
            {!! Form::open(['route' => 'admin.stock.inventory.storeWithVariant', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}  
              <div id="" class="hidden veriant">
                  <div id="showCobination"></div>
              </div>
            {!! Form::close() !!}
                
          </div>
 
        </div>
    </div>
  </div><!-- /.col-md-8 -->

  {{-- <div class="col-md-4 nopadding-left">
    <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">{{ trans('app.additional_info') }}</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <div class="form-group">
          {!! Form::label('available_from', trans('app.form.available_from'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.available_from') }}"></i>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            {!! Form::text('available_from', null, ['class' => 'datetimepicker form-control', 'placeholder' => trans('app.placeholder.available_from')]) !!}
          </div>
        </div>

        @if($requires_shipping)
          <fieldset>
            <legend>{{ trans('app.shipping') }}</legend>
            <div class="form-group">
              <div class="input-group">
                {{ Form::hidden('free_shipping', 0) }}
                {!! Form::checkbox('free_shipping', null, null, ['id' => 'free_shipping', 'class' => 'icheckbox_line']) !!}
                {!! Form::label('free_shipping', trans('app.form.free_shipping')) !!}
                <span class="input-group-addon" id="">
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.free_shipping') }}"></i>
                </span>
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('warehouse_id', trans('app.form.warehouse'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_warehouse') }}"></i>
              {!! Form::select('warehouse_id', $warehouses, isset($inventory) ? null : config('shop_settings.default_warehouse_id'), ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('shipping_weight', trans('app.form.shipping_weight'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.shipping_weight') }}"></i>
              <div class="input-group">
                {!! Form::number('shipping_weight', null, ['class' => 'form-control', 'step' => 'any', 'min' => 0, 'placeholder' => trans('app.placeholder.shipping_weight')]) !!}
                <span class="input-group-addon">{{ config('system_settings.weight_unit') ?: 'gm' }}</span>
              </div>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              {!! Form::label('packaging_list[]', trans('app.form.packagings'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_packagings') }}"></i>
              {!! Form::select('packaging_list[]', $packagings , isset($inventory) ? null : config('shop_settings.default_packaging_ids'), ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
            </div>
          </fieldset>
        @endif

        @if(count($attributes))
          <fieldset class="collapsible">
            <legend>{{ trans('app.attributes') }}</legend>
            @foreach ($attributes as $attribute)
              <div class="form-group">
                {!! Form::label($attribute->name, $attribute->name) !!}

                <select class = "form-control select2" id="{{ $attribute->name }}" name="variants[{{ $attribute->id }}]" placeholder = {{ trans('app.placeholder.select') }}>

                  <option value="">{{ trans('app.placeholder.select') }}</option>

                  @foreach($attribute->attributeValues as $attributeValue)
                    <option value="{{ $attributeValue->id }}"
                      @if(isset($inventory) && count($inventory->attributes))
                        {{ in_array($attributeValue->id, $inventory->attributeValues->pluck('id')->toArray()) ? 'selected' : '' }}
                      @endif
                    >
                      {{ $attributeValue->value }}
                    </option>
                  @endforeach
                </select>
              </div>
            @endforeach
          </fieldset>
        @endif

        <fieldset>
          <legend>{{ trans('app.reporting') }}</legend>
          <div class="form-group">
            {!! Form::label('purchase_price', trans('app.form.purchase_price'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.purchase_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              {!! Form::number('purchase_price', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.purchase_price')]) !!}
            </div>
          </div>
          @if($requires_shipping)
            <div class="form-group">
              {!! Form::label('supplier_id', trans('app.form.supplier'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_supplier') }}"></i>
              {!! Form::select('supplier_id', $suppliers, isset($inventory) ? null : config('shop_settings.default_supplier_id'), ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
            </div>
          @endif
        </fieldset>

        <fieldset>
          <legend>{{ trans('app.seo') }}</legend>
          <div class="form-group">
            {!! Form::label('slug', trans('app.form.slug').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slug') }}"></i>
            {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'SEO Friendly URL', 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
            {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('meta_title', trans('app.form.meta_title'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_title') }}"></i>
            {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_title')]) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('meta_description', trans('app.form.meta_description'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_description') }}"></i>
            {!! Form::text('meta_description', null, ['class' => 'form-control', 'maxlength' => config('seo.meta.description_character_limit', '160'), 'placeholder' => trans('app.placeholder.meta_description')]) !!}
            <div class="help-block with-errors"><small><i class="fa fa-info-circle"></i> {{ trans('help.max_chat_allowed', ['size' => config('seo.meta.description_character_limit', '160')]) }}</small></div>
          </div>
        </fieldset>
      </div>
    </div>
  </div> --}}

  <!-- /.col-md-4 -->
</div><!-- /.row -->

<script>
  {{-- alert('sdsd6') --}}
  // $(document).on('click','.show_vitalInfo',function(){
    // alert('sdsd')
    // var targetClass = $(this).attr('targetID')
    // $('#vital_information').addClass('hidden')
    // $('#customise_property').addClass('hidden')
    // // $('#vital_information').addClass('hidden')
    // // $('#vital_information').addClass('hidden')

    // $('#'+targetClass).removeClass('hidden')
    // $('#'+targetClass).addClass('show')
  
  // })
</script>