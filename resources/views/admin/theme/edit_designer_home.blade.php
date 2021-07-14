<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::open(['route' => [$route,$id], 'method' => 'PUT', 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.featured_categories') }}
        </div>

        <div class="modal-body">
            <div class="form-group">
              {!! Form::label('featured_categories[]', trans('app.form.categories').'*') !!}
              <select class="form-control select2-normal" name="designer_home[]" multiple required>
              	<option></option>
              	@foreach($categories as $Cat)
              		<option {{in_array($Cat->id, $catArray) ? 'selected' : ''}} value={{$Cat->id}}>{{$Cat->name}}</option>
              	@endforeach
              </select>             
              <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->