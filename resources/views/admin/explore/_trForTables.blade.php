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
		<td></td>
		<td></td>
		<td></td>
		<td>
			<a href="javascript:void(0)" data-link="{{ route('admin.catalog.attribute.massTrash') }}" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> {{ trans('app.trash') }}</a>
			<a href="javascript:void(0)" data-link="{{ route('admin.catalog.attribute.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a>
		</td>
	</tr>
@endforeach