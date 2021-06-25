<div class="row" style="margin-top: 50px"> 
	@foreach($product as $Product)
		<div class="col-md-4" style="margin-bottom: 20px;">
			<div class="card card-custom bg-white border-white border-0">	        
	          <div class="card-body" style="overflow-y: auto">
	          	<div class="text-center">
	            	<h4 class="card-title">What do you like to post?</h4>
	            </div>	
	          </div>
	          <div class="card-footer text-center" >
	            <a href="javascript:void(0)" data-link="{{url('admin/explore/create')}}" class="btn btn-primary ajax-modal-btn">Add Post</a>	            
	          </div>
	        </div>
		</div>
	@endforeach	
</div>