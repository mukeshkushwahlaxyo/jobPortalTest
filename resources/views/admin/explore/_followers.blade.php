<div class="row" style="margin-top: 50px"> 
	@if(count($follower))
		@foreach($follower as $Follwer)
			<div class="col-md-3" style="margin-bottom: 20px;">
				<div class="card card-custom bg-white border-white border-0">	
					{{-- <div class="row"> --}}
						{{-- <div class="col-md-12"> --}}
						{{-- </div> --}}
		          	<div class="card-body" style="overflow-y: auto">
					</div>        
		          		<div class="row" style="margin-left:0px !important; margin-right:0px !important;">
				          	<div class="col-md-3" style=" margin-top: 4% !important;">
				            	@if($Follwer->getFollowers->image)
									<img style="
											width:100% !important;
											margin-left:5%;   
											border-radius: 100%;
											height: 59px;" 
											src="{{ get_storage_file_url($Follwer->getFollowers->image->path,'') }}" class="" alt="{{ trans('app.image') }}"
										>
								@endif
								
				            </div>
				          	<div class="col-md-6" style="margin-top: 5%;" >
				          		<div style="
									margin-left: 4%;
									font-family: DM Sans;
									font-style: normal;
									font-weight: bold;
									font-size: 16px;
									line-height: 20px;
									align-items: center;
									color: #0A0A0A;
									display: inline;
									margin-top: 10px !important;

									" class="customerName">{{$Follwer->getFollowers->name}}
								</div>
								<div style="
									margin-left: 4%;
									font-family: DM Sans;
									font-style: normal;
									font-size: 14px;
									line-height: 20px;

									" class="customerName">{{$Follwer->getFollowers->email}}
								</div>
				          	</div>
			          		<div class="col-md-3 text-right">
								<a class="deleteAny" reference-class="showContant" data-link="{{url('admin/explore/deleteFollowers',$Follwer->id)}}" ><i class="fa fa-trash"></i></a>
							</div>	
				        </div>    	
		          </div>
		          <div class="card-footer " >
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