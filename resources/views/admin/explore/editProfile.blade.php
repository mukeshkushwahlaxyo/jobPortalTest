<form action="{{url('admin/saveMerchantProfile')}}" enctype="multipart/form-data" method="POST" id="postForm">
	@csrf
	<div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	{!! Form::open(['route' => 'admin.catalog.attribute.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        	{{ trans('app.form.form') }}
	        </div>
	        <div class="modal-body">
		       		@include('admin.explore.profile_edit_form')
	        </div>
	      
	        <div class="modal-footer">
	            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
	        </div>

	       {{--  <img src="https://helpx.adobe.com/content/dam/help/en/photoshop/using/convert-color-image-black-white/jcr_content/main-pars/before_and_after/image-before/Landscape-Color.jpg" alt="Workplace" usemap="#workmap" width="400" height="379">

			<map name="workmap">
			  <area shape="rect" coords="34,44,270,350" alt="Computer" href="computer.htm">
			  <area shape="rect" coords="290,172,333,250" alt="Phone" href="phone.htm">
			  <area shape="circle" coords="337,300,44" alt="Cup of coffee" href="coffee.htm">
			</map> --}}
	        
	    </div> <!-- / .modal-content  https://helpx.adobe.com/content/dam/help/en/photoshop/using/convert-color-image-black-white/jcr_content/main-pars/before_and_after/image-before/Landscape-Color.jpg -->
	</div> 
</form>	