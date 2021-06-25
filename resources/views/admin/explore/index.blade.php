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
			        	<div id="exploreProfileBackImage">
			        		<div id="profileImage">
			        			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF28fh64NjxRTsy5-BtEQ9vdGIa7CvhZOQjw&usqp=CAU">
			        		</div>
			        	</div>
			        </div>	
			        <div class="text-center designerText">
			        	<span class="fontDesign">Designer Name</span>
			        </div>
		        	<div class="tabs">
		        		<ul class="nav nav-tabs">
						  <li class="nav-item">
						    <a class="nav-link active" onclick="getExploreTabsData('post')" href="#">Posts</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" onclick="getExploreTabsData('product')" href="#">Products</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" onclick="getExploreTabsData('reviews')" href="#">Reviews</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link disabled" onclick="getExploreTabsData('followers')" href="#">Followers</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link disabled" onclick="getExploreTabsData('about')" href="#">About</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link disabled" onclick="getExploreTabsData('message')" href="#">Message</a>
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