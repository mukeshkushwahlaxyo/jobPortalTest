<div>
	<div class="row">
		<div class="col-md-5" style="margin-top: 50px; margin-bottom: 50px; min-height: 129px ;">
			<div class="card addpost bg-white border-white border-0">	        
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
		<div class="col-md-7"></div>
	</div>		
	<div class="card card-custom-table bg-white border-white border-0">	
		<table class="table table-hover table-2nd-no-sort dataTable" id="sortable" style="padding-left: 50px;">
	        <thead>
		        <tr>
		            <th width="7px">{{ trans('app.#') }}</th>
			        <th>{{ trans('Image') }}</th>
			        <th>{{ trans('Title Of Post') }}</th>
			        <th>{{ trans('Description') }}</th>
			        <th>{{ trans('Date') }}</th>		
			        <th>{{ trans('Likes') }}</th>
			        <th>{{ trans('Share') }}</th>
			        <th>{{ trans('Comment') }}</th>				        
			        <th>{{ trans('app.option') }}</th>
		        </tr>
	        </thead>
	        <tbody id="massSelectArea">
	        	<?php $count =  1; ?>
		        @foreach($post as $Post)
		        	<tr>
		        		<td>{{$count++}}</td>
		        		<td>
		        			@if($Post->image)
								<img src="{{ get_storage_file_url($Post->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
							@endif
		        		</td>
		        		<td>{{$Post->title}}</td>
		        		<td>{{$Post->description}}</td>
		        		<td>{{date('d-m-Y',strtotime($Post->created_at))}}</td>
		        		<td>{{count($Post->like)}}</td>
		        		<td>{{count($Post->share)}}</td>
		        		<td>{{count($Post->comments)}}</td>
		        		<td>
		        			<a href="javascript:void(0)" data-link="{{ url('admin/explore/edit',$Post->id) }}" class="massAction ajax-modal-btn" data-doafter="reload"><i class="fa fa-pencil-square-o"></i> </a>
							<a href="javascript:void(0)" data-link="{{ url('admin/explore/deletePost',$Post->id) }}" class="delete" data-doafter="reload"><i class="fa fa-times"></i></a>
		        		</td>
		        	</tr>
		        @endforeach
	        </tbody>
		</table>
	</div>    
</div>

<script>
	$(document).ready(function() {
    	$('#sortable').DataTable();	
	} );
</script>