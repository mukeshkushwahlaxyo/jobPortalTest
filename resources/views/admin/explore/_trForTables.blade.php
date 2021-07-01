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
		<td></td>
		<td>{{count($Post->like)}}</td>
		<td>{{count($Post->share)}}</td>
		<td>{{count($Post->comments)}}</td>
		<td>
			<a href="javascript:void(0)" data-link="{{ url('admin/explore/edit',$Post->id) }}" class="ajax-modal-btn" data-doafter="reload"><i class="fa fa-pencil-square-o"></i> </a>
			<a href="javascript:void(0)" data-link="{{ url('admin/explore/deletePost',$Post->id) }}" class="delete" data-doafter="reload"><i class="fa fa-times"></i> </a>
		</td>
	</tr>
@endforeach