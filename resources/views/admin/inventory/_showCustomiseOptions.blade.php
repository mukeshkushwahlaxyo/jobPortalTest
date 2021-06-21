<form id="customize_form">
	{{-- <div class="row">    --}}
      <div class="col-sm-12 col-md-12">       
        <ul class="nav nav-tabs mb-4" >
        	{{-- {{dd($attribute)}} --}}
        @php  $count = 1 ; @endphp
        @foreach($attribute as $Attribute)
        	@if(count($Attribute))
	       	  @foreach($Attribute as $Attr)
		          <li class="nav-item showCutomise  {{$count === 1 ? '' : ''}}" data-id="{{$count}}" data-id1="{{$Attr->attribute_id}}{{$Attr->attribute_sublist_id !==null  ? $Attr->attribute_sublist_id:''}}" >
		            <a class="nav-link " href="#" aria-current="page" >{{$Attr->attribute->name}} {{$Attr->attributeSublist !== null ? "(".$Attr->attributeSublist->name.")" : ''}}</a>
		          </li>
	        	@php $count++; @endphp
	        	@endforeach
	        @endif		            
        @endforeach            
        </ul>
      </div>
    {{-- </div> --}}
    @php 

    	$Catcount=1; 
    	$isSubmit = false;

    @endphp

  		@foreach($attribute as $Attribute)
  		 @if(count($Attribute) > 0)		
	  			@php 
	  				$isSubmit=true; 
	  			@endphp 
			  			@foreach($Attribute as $categoryAttr)
			  				@php
			  					$sublistId = $categoryAttr->attribute_sublist_id === null ? '':$categoryAttr->attribute_sublist_id;
				  				$selectedCategory = getCategoryTabs($categoryAttr->attribute_id,$sublistId);
			  				@endphp
  					    <div class="col-md-12 attrVallContainer {{$Catcount}} {{$Catcount === 1 ? '' : 'hidden'}}" style="padding-top: 20px;">
						    @foreach($attributeCategory->categories as $secondKey => $Cate)
					    		<span style=" margin-left: 20px; display: 'inline';"> 
						    		<input {{in_array($Cate->id, $selectedCategory) ? 'checked':''}} class="getValuesOfCate" 
						    					data-id="{{$categoryAttr->attribute_id}}{{$categoryAttr->attribute_sublist_id === null ? '':$categoryAttr->attribute_sublist_id}}{{$Cate->id}}"
						    					updat-id="{{$categoryAttr->attribute_id}},{{$categoryAttr->attribute_sublist_id === null ? '':$categoryAttr->attribute_sublist_id}}"
						    					type="checkbox" 
						    					style="margin-right: 5px;" 
						    					name="{{$categoryAttr->attribute_id}},{{$categoryAttr->attribute_sublist_id === null ? '':$categoryAttr->attribute_sublist_id}}[]" 
						    					value="{{$Cate->id}}" 
						    					id="category_{{$Cate->id}}">
						    					{{$Cate->name}}
						    		</span>		   		
				    		@endforeach		
			    			</div>
				    	@endforeach	
			    @endif	
	    	@php $Catcount++; @endphp
    	@endforeach		

    @php 
    	$valCount = 1;
    @endphp	
    @foreach($attribute as $Attribute)		
	    @foreach($Attribute as $secondKey => $attr)		
	    	@foreach($attributeCategory->categories as $secondKey =>$Category )		
		   		<div id="val_{{$attr->attribute_id}}{{$attr->attribute_sublist_id === null ? '':$attr->attribute_sublist_id}}{{$Category->id}}" class="col-md-12 showAttributeValuesOfCategory {{$valCount}} attrVallContainer">
		   		</div> 					
		  	@endforeach		
		  @endforeach		
		  @php  $valCount++; @endphp 
		@endforeach	
			<div class="row saveButton hidden">
				<div class="col-md-12 text-center">			
					<button class="btn btn-default">Save</button>
				</div>
			</div>
	</form>	