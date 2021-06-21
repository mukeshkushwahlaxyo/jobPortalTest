 @php $valueCount=1; @endphp
@foreach($attributeValue as $arrykey => $array)	
	<div class="val_{{$ids}}">
    	<div class="col-md-1" style="margin-top:25px;">	
				<input class="attrValue_id" {{in_array($array->id,$selectedalueIds) ? 'checked':''}} name="vall_{{$ids}}[]" type="checkbox" value="{{$array->id}}">
				<div>
					<img src="{{ get_storage_file_url($array->image->path) }}" class="img-sm1" alt="{{ trans('app.image') }}">
				</div>
				<div>
					<div>
						Name:{{$array->value}}<br>
						Value:{{$array->color}}
					</div>
				</div>
			</div>
		</div>	
    
    @php $valueCount++; @endphp
@endforeach