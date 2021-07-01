@extends('admin.layouts.master')


@section('content')

	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">
			{{ trans('app.general_settings') }}
	      </h3>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	    	<div class="row">
		        <div class="col-md-1"></div>
		        <div class="col-md-10">
		        	<div class="imageWrap">
		        		@if(isset($profileInfo->images[1]))
	        				@php
	        					$backpath = $profileInfo->images[1]->type ==='cover' ? get_storage_file_url($profileInfo->images[1]->path,''):get_storage_file_url($profileInfo->images[0]->path,'');
	        				@endphp
	        				
	        			@else
	        				@php
	        					$backpath ='https://www.blogenium.com/wp-content/uploads/2019/08/blogenium-nature-wallpapers-1.jpg';
	        				@endphp	
	        			@endif
			        	<div id="exploreProfileBackImage" style="background-image:url('{{ $backpath}}')">
			        		<div id="profileImage">
			        			@if(isset($profileInfo->images[0]))
			        				@php
			        					$path = $profileInfo->images[0]->type ==='feature' ? $profileInfo->images[0]->path:$profileInfo->images[1]->path;
			        				@endphp
			        				<img src="{{ get_storage_file_url($path, '') }}">
			        			@else
			        				<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF28fh64NjxRTsy5-BtEQ9vdGIa7CvhZOQjw&usqp=CAU">
			        			@endif
			        		</div>
			        	</div>
			        </div>	
			        <div class="text-center designerText">
			        	<span class="fontDesign">{{$profileInfo->name}}</span>
			        </div>
		        	<div class="tabs">
		        		<div >
		        			<a class="btn btn-default ajax-modal-btn" 
		        				style="
		        					float: right;
		        				    float: right;
								    margin-right: 33px;
								    padding: 8px 43px;
								    border-radius: 10px;
								    background-color: #C4C4C4;"

								data-link="{{url('admin/editProfile')}}"    
							>
		        				<i class="fa fa-pencil"></i>Edit</a>
		        		</div>
		        		<ul class="nav nav-tabs">
						  <li class="nav-item">
						    <a class="nav-link active" onclick="getExploreTabsData('post')" >Posts({{$postcount}})</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" onclick="getExploreTabsData('product')" >Products({{$productcount}})</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" onclick="getExploreTabsData('reviews')" >Reviews({{$reviewscount}})</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link disabled" onclick="getExploreTabsData('followers')" >Followers({{$followerscount}})</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link disabled" onclick="getExploreTabsData('about')" >About</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link disabled" onclick="getExploreTabsData('message')" >Message</a>
						  </li>
						 </ul> 		
		        	</div>
		        	<div class="showContant"></div>
		        </div>
		        <div class="col-md-1"></div>
	    	</div>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection