<div class="card card-custom-table bg-white border-white border-0" style="margin-top:50px">	
		<table class="table table-hover table-2nd-no-sort dataTable" id="sortable" >
	        <thead>
		        <tr>
		            <th width="7px">{{ trans('app.#') }}</th>
			        <th>{{ trans('Image') }}</th>
			        <th>{{ trans('Name') }}</th>
			        <th>{{ trans('Phone') }}</th>
			        <th>{{ trans('Email') }}</th>				        
			        <th>{{ trans('app.option') }}</th>
		        </tr>
	        </thead>
	        <tbody id="massSelectArea">
	        	<?php $count =  1; ?>
		        @foreach($follower as $Foll)
		        	<tr>
		        		<td>{{$count++}}</td>
		        		<td>
		        			@if($Foll->getFollowers->image)
								<img
								style="width: 57px;height: 54px;border-radius: 100%;"
								 src="{{ get_storage_file_url($Foll->getFollowers->image->path, '') }}" alt="{{ trans('app.image') }}">
							@endif
		        		</td>
		        		<td>{{$Foll->getFollowers->name}}</td>
		        		<td></td>
		        		<td>{{$Foll->getFollowers->email}}</td>
		        		<td>
		        			<a href="javascript:void(0)" data-link="{{ url('admin/explore/edit',$Foll->id) }}" class="massAction ajax-modal-btn" data-doafter="reload"><i class="fa fa-pencil-square-o"></i> </a>
							<a href="javascript:void(0)" data-link="{{ route('admin.catalog.attribute.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i></a>
		        		</td>
		        	</tr>
		        @endforeach
	        </tbody>
		</table>
	</div>