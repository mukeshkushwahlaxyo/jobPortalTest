<div class="row" style="margin-top: 50px"> 
	@if(count($product))
		@foreach($product as $Product)
			<div class="col-md-3" style="margin-bottom: 20px;">
				<div class="card card-custom bg-white border-white border-0">	  
				<div class="designerName" 
					style="margin-left:12px;
					 margin-bottom: 10px;
					 font-family: DM Sans;
				    font-style: normal;
				    font-weight: bold;
				    font-size: 14px;
				    line-height: 18px;

				    color: #000000;
					 ">
					{{$profile->name}}
				</div>      
		          <div class="card-body" style="overflow-y: auto">
		          	<div class="" style="width: 100%; background-image: ;">
		            	@if($Product->image)
							<img src="{{ get_storage_file_url($Product->image->path,'') }}"  alt="{{ trans('app.image') }}">
						@endif
		            </div>	
		          </div>
		          <div class="card-footer productDetails" >
		            <span class="productName">{{$Product->product->name}}</span><br>	            
		            <span>{{number_format($Product->sale_price,2)}}</span>	            
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