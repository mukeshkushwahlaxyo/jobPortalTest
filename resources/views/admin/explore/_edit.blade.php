<form action="{{url('admin/explore/update',$post->id)}}" enctype="multipart/form-data" method="PUT" id="postForm">
	@csrf
	@method('PUT')
	<div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	{!! Form::open(['route' => 'admin.catalog.attribute.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        	{{ trans('app.form.form') }}
	        </div>
	        <div class="modal-body">
		       		@include('admin.explore._form_post')

	        </div>
	        <div class="modal-footer">
	            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
	        </div>
	        
	    </div> <!-- / .modal-content -->
	</div> 
</form>	