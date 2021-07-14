
<form id="getCustomeValues">
	@csrf
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-5">
			<div class="form-group" style="margin-top: 15px;">
	            {{-- {!! Form::label('Attribute', ['class' => 'with-help']) !!} --}}
	            <select class="form-control select2-set_attribute attributeCstom" name="attributeId[]" multiple="true" >
	                @foreach($attributesCustom as $attributeCustome)                    
		                @if(count($attributeCustome->attributeSublist))
		                	@foreach($attributeCustome->attributeSublist as $Sublist)
		                    	<option value="{{$attributeCustome->id}},{{$Sublist->id}}" >{{$attributeCustome->name}} ({{$Sublist->name}})</option>
		                    @endforeach	
		                @else
		                   <option value="{{$attributeCustome->id}}," >{{ $attributeCustome->name }}</option>    
		                @endif    
	                @endforeach
	            </select>
	        </div>
		</div>
		<div class="col-md-5"></div>
	</div>

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-5">

			<input type="hidden" name="inventory_id" value="{{isset($inventory) ? $inventory->id:''}}">
			<div class="form-group" style="margin-top: 15px;">
	          	<button class="btn btn-default">Attribute Value</button>
	        </div>
		</div>
		<div class="col-md-5"></div>
	</div>
	<hr>
</form>
<div class="row">
	<div class="col-md-12">
		<div id="showAttributeValues"></div>
	</div>	
</div>	