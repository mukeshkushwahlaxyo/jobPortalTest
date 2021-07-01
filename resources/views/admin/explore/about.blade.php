<div class="row">
	<div class="col-md-12" style="margin-top: 50px; margin-bottom: 50px;">
		<div class="card addpost bg-white border-white border-0">	        
          <div class="card-body" style="overflow-y: auto">
          	<div class="abouttitle text-left">
          		About
            </div>	
            <div>
            	<hr>
            </div>

            <div style="margin-left: 10px;" class="exprience text-left">
            	<div style="margin: 40px 0 30px;">
          			<span  class="headingText">Experience : </span><span>{{$about->exprience}}</span>
          		</div>
          		<div style="margin-bottom: 40px;">
          			<span   class="headingText">Experience Details : </span><span>{{$about->description}}</span>
          		</div>
            </div>	
            <div>
            	<hr>
            </div>

            <div style="margin-left: 10px;" class=" text-left">
          		<span class="headingText">Location : </span><span>{{$about->location}}</span>
            </div>	
            <div>
            	<hr>
            </div>

            <div style="margin-left: 10px;" class="text-left">
          		<span class="headingText">Last Delivery : </span><span>{{$about->lastdelivery}}</span>
            </div>	
            <div>
            	<hr>
            </div>

          </div>
          <div class="card-footer text-center" >
            <a href="javascript:void(0)" data-link="{{url('admin/explore/create')}}" class="btn btn-primary ajax-modal-btn">Add Post</a>	            
          </div>
        </div>
	</div>
	<div class="col-md-7"></div>
</div>