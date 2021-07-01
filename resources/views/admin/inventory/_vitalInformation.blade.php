    {{-- <form id="vitalInfoForm" action="{{route('admin.stock.inventory.store')}}"  method="post"> --}}
      {{-- @csrf --}}
      {{-- {{dd($inventory)}} --}}
  	 <div class="row " style="margin-top: 31px;" >
        <div class="col-md-10">
          <div class="form-group">
            {!! Form::label('title', trans('app.form.title').'*') !!}
            {!! Form::text('title', isset($inventory) ? $inventory->title:  null, ['class' => $title_classes, 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_inventory_status') }}"></i>
            {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], isset($inventory) ? $inventory->active : 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('sku', trans('app.form.sku').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sku') }}"></i>
            {!! Form::text('sku', isset($inventory) ?  $inventory->sku :  null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.sku'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('Textile', trans('Textile').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sku') }}"></i>
            {!! Form::text('textile', isset($inventory) ?  $inventory->textile: null, ['class' => 'form-control', 'placeholder' => trans('Textile'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>  
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('condition', trans('app.form.condition').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_product_condition') }}"></i>
            {!! Form::select('condition', ['New' => trans('app.new'), 'Used' => trans('app.used'), 'Refurbished' => trans('app.refurbished')], isset($inventory) ? $inventory->condition : 'New', ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('condition_note', trans('app.form.condition_note'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_condition_note') }}"></i>
            {!! Form::text('condition_note', isset($inventory) ?  $inventory->condition_note: Null, ['class' => 'form-control input-sm', 'required','placeholder' => trans('app.placeholder.condition_note')]) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div> 
    
      <div class="row">
        <div class="col-md-4 ">
          <div class="form-group">
            {!! Form::label('offer_start', trans('app.form.offer_start'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_start') }}"></i>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              {!! Form::text('offer_start', isset($inventory) ?  $inventory->offer_start : null, ['class' => 'form-control datetimepicker','required' ,'placeholder' => trans('app.placeholder.offer_start')]) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="col-md-4 ">
          <div class="form-group">
            {!! Form::label('offer_end', trans('app.form.offer_end'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_end') }}"></i>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              {!! Form::text('offer_end', isset($inventory) ?  $inventory->offer_end : null, ['class' => 'form-control datetimepicker', 'required','placeholder' => trans('app.placeholder.offer_end')]) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="col-md-4 ">
          <div class="form-group">
            {!! Form::label('available_from', trans('available_from'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_end') }}"></i>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              {!! Form::text('available_from', isset($inventory) ?  $inventory->available_from :null, ['class' => 'form-control datetimepicker', 'required','placeholder' => trans('app.placeholder.available_from')]) !!}
            </div>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 ">
          <div class="form-group">
            {!! Form::label('sale_price', trans('app.form.sale_price').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sale_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              <input required name="sale_price" value="{{ isset($inventory) ? $inventory->sale_price : Null }}" type="number" min="{{ $product->min_price }}" {{ $product->max_price ? ' max="'. $product->max_price .'"' : '' }} step="any" placeholder="{{ trans('app.placeholder.sale_price') }}" class="form-control" required="required">
            </div>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            {!! Form::label('offer_price', trans('app.form.offer_price'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              {!! Form::number('offer_price',isset($inventory) ?  $inventory->offer_price : null, ['class' => 'form-control', 'step' => 'any', 'required','placeholder' => trans('app.placeholder.offer_price')]) !!}
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            {!! Form::label('Price+Shipping', trans('Price+Shipping'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              {!! Form::number('price_shipping',isset($inventory) ?  $inventory->price_shippin : null, ['class' => 'form-control', 'step' => 'any', 'required','placeholder' => trans('Price+Shipping')]) !!}
            </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-4 ">
          <div class="form-group">
            {!! Form::label('stock_quantity', trans('app.form.stock_quantity').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.stock_quantity') }}"></i>
            {!! Form::number('stock_quantity', isset($inventory) ? $inventory->stock_quantity : 1, ['min' => 0, 'class' => 'form-control', 'placeholder' => trans('app.placeholder.stock_quantity'), 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="col-md-4 ">
          <div class="form-group">
            {!! Form::label('min_order_quantity', trans('app.form.min_order_quantity'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.min_order_quantity') }}"></i>
            {!! Form::number('min_order_quantity', isset($inventory) ? $inventory->min_order_quantity : 1, ['min' => 1, 'class' => 'form-control', 'required','placeholder' => trans('app.placeholder.min_order_quantity')]) !!}
          </div>
        </div>
      </div>

      @include('admin.inventory._common')

      <fieldset>
        <legend>{{ trans('app.form.images') }}</legend>
        <div class="form-group">
          <div class="file-loading">
            <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
          </div>
          <span class="small"><i class="fa fa-info-circle"></i> {{ trans('help.multi_img_upload_instruction', ['size' => getAllowedMaxImgSize(), 'number' => getMaxNumberOfImgsForInventory()]) }}</span>
        </div>
        <input type="hidden" name="product_id" value="{{$product->id}}">
      </fieldset>

    {{-- <fieldset>
      <legend>{{ trans('app.inventory_rules') }}</legend>
      @if($requires_shipping)
        
      @endif

      <div class="row">
        <div class="col-md-6 ">
          <div class="form-group">
            {!! Form::label('sale_price', trans('app.form.sale_price').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sale_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              <input name="sale_price" value="{{ isset($inventory) ? $inventory->sale_price : Null }}" type="number" min="{{ $product->min_price }}" {{ $product->max_price ? ' max="'. $product->max_price .'"' : '' }} step="any" placeholder="{{ trans('app.placeholder.sale_price') }}" class="form-control" required="required">
            </div>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6 nopadding-left">
          <div class="form-group">
            {!! Form::label('offer_price', trans('app.form.offer_price'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              {!! Form::number('offer_price', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.offer_price')]) !!}
            </div>
          </div>
        </div>
      </div>

      

      <div class="form-group">
        {!! Form::label('linked_items[]', trans('app.form.linked_items'), ['class' => 'with-help']) !!}
        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.inventory_linked_items') }}"></i>
        {!! Form::select('linked_items[]', $inventories , isset($inventory) ? unserialize($inventory->linked_items) : Null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </fieldset> --}}

    <p class="help-block">* {{ trans('app.form.required_fields') }}</p>

   {{--  @if(isset($inventory))
      <a href="{{ route('admin.stock.inventory.index') }}" class="btn btn-default btn-flat">{{ trans('app.form.cancel_update') }}</a>
    @endif --}}

    <button class='btn btn-flat btn-lg btn-new pull-right'>{{trans('Save')}}</button>
  {{-- </form>   --}}