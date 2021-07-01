<div class="row" style="margin-top: 50px"> 
	@if(count($review))
		@foreach($review as $Review)
			<div class="col-md-3" style="margin-bottom: 20px;">
				<div class="card card-custom bg-white border-white border-0">	        
		          <div class="card-body" style="overflow-y: auto">
		          		<div class="">
				          	<div class="review-image" style=" margin-top: 4% !important;">
				            	@if($Review->customer->image)
									<img style="
											width: 20% !important;
											margin-left:5%;   
											border-radius: 100%;
											height: 59px;" 
											src="{{ get_storage_file_url($Review->customer->image->path,'') }}" class="" alt="{{ trans('app.image') }}"
										>
								@endif
								<span style="
										margin-left: 4%;
										font-family: DM Sans;
										font-style: normal;
										font-weight: bold;
										font-size: 16px;
										line-height: 20px;
										align-items: center;
										color: #0A0A0A;
										display: inline;

									" class="customerName">{{$Review->customer->name}}</span>
				            </div>
				          	<div class="review-image" style="margin-left: 5% !important; margin-top: 5%;" >
				          		@php
				          			$count = 1;
				          		@endphp
				          		@while( $count <= 5 )
				          			@if($count < $Review->rating)
				          		  		<span class="fa fa-star checked"></span>
				          		  	@else	
								  	    <span class="fa fa-star"></span>
								  	@endif    
								  @php $count++; @endphp
								@endwhile  
				          	</div>
				        </div>    	
		          </div>
		          <div class="card-footer productDetails" >
		            {{$Review->description}}	            
		          </div>
		        </div>
			</div>
		@endforeach	
	@else
		<div class="col-md-12 text-center">
			No record found..
		</div>
	@endif	
</div>

<style>
.checked {
  color: orange;
}
</style>