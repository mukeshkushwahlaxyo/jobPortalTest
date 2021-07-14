@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.theme_options') }}</h3>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	    	<table class="table table-stripe">
	    		<thead>
	    			<tr>
	    				<th>@lang('app.options')</th>
	    				<th>@lang('app.values')</th>
	    				<th>&nbsp;</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<tr>
	    				<th>Trending</th>
	    				<td>
	    					@foreach($trending_categories as $trending)
			    				<span class="label label-outline">{{ $trending->getCategory->name }}</span>
	    					@endforeach
	    				</td>
	    				<td>
	    					<a href="javascript:void(0)" data-link="{{ url('/admin/appearance/theme/edit_designer_home',2) }}" class="ajax-modal-btn btn btn-sm btn-default flat"><i class="fa fa-edit"></i> @lang('app.edit')</a>
	    				</td>
	    			</tr>
	    			<tr>
	    				<th>Top Designer</th>
	    				<td>
	    					@foreach($top_designer as $designer)
			    				<span class="label label-outline">{{ $designer->getMerchant->name }}</span>
	    					@endforeach
	    				</td>
	    				<td>
	    					<a href="javascript:void(0)" data-link="{{ url('/admin/appearance/theme/EditDesignerOption',7) }}" class="ajax-modal-btn btn btn-sm btn-default flat"><i class="fa fa-edit"></i> @lang('app.edit')</a>
	    				</td>
	    			</tr>
	    			<tr>
	    				<th>Suit Wear</th>
	    				<td>
	    					@foreach($suit_wear as $SuitWear)
			    				<span class="label label-outline">{{ $SuitWear->getCategory->name }}</span>
	    					@endforeach
	    				</td>
	    				<td>
	    					<a href="javascript:void(0)" data-link="{{ url('/admin/appearance/theme/edit_designer_home',6) }}" class="ajax-modal-btn btn btn-sm btn-default flat"><i class="fa fa-edit"></i> @lang('app.edit')</a>
	    				</td>
	    			</tr>
					<tr>
	    				<th>Hand Made Cloth</th>
	    				<td>
	    					@foreach($hand_made_cloth as $handMade)
			    				<span class="label label-outline">{{ $handMade->getCategory->name }}</span>
	    					@endforeach
	    				</td>
	    				<td>
	    					<a href="javascript:void(0)" data-link="{{ url('/admin/appearance/theme/edit_designer_home',5) }}" class="ajax-modal-btn btn btn-sm btn-default flat"><i class="fa fa-edit"></i> @lang('app.edit')</a>
	    				</td>
	    			</tr>					
	    		</tbody>
	    	</table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection