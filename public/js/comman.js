 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

 function getAttributeValue(attrIds){
	apply_busy_filter();
	var productId = $('#productID').val();
	$.ajax({
		method:'post',
		url:'/admin/stock/inventory/getAttributeValue/',
		data:attrIds,
		success:function(res){
			$('#showAttributeValues').html(res)
			$('.showAttributeValuesOfCategory').addClass('hidden')
			var data = $("input[class=getValuesOfCate]:checked");
			var isShow = true
			var count  = 0;
			data.each((index,value)=>{
				var ids  = $(value).attr('updat-id')
				ids =  ids.split(',')
				var attrID = ids[0]
				var attrsSublistID = ids[1]
				var catId = $(value).val()	
				var ids = $(value).attr('data-id')		
				getValues(catId,ids,attrID,attrsSublistID,isShow)
				if(count === 0){
					isShow = false
				}
				count++
			})

			remove_busy_filter();
		}
	})
}


$(document).on('change','.attribute_sublist_id',function(){
	var attrID = $('#sublist_for_custom').val()
	var attrSublistID = $(this).val()
	$('#showAttributeValues').removeClass('hidden')
	$('#showAttributeValues').addClass('show')

	getAttributeValue(attrID,attrSublistID)
})

$(document).on('change','#sublist_for_custom',function(){
	var id = $(this).val()
	$.ajax({
            method:'get',
            url:'/admin/catalog/attributeValue/sublist/'+id,
            success:function(res){
            	if(res.sublist.length > 0 || res.isCustom.product_type === 2){

            		if(res.sublist.length > 0){
		            	var html = ''
		              res.sublist.map((value,index)=>{
		             	html +="<option selected=selected value='"+value.id+"'>"+value.name+"</option>"	
		             })
		              $('.attribute_sublist_id').html(html)
		              $('.sublist_container').removeClass('hidden')
		              $('.sublist_container').addClass('show')
		              $('#showAttributeValues').addClass('hidden')
		            }
		             else{
		             	$('.sublist_container').addClass('hidden')
		             	$('#showAttributeValues').removeClass('hidden')
		              	$('#showAttributeValues').addClass('show')
		        		getAttributeValue(id)
		        	}

		        	$('#attr_id').val(id)
		        }
		       
		    }
		})
})

$(document).on('click','.show_vitalInfo, .show_veriant,.show_customise_property ,.show_price, .show_more_details',function(){
    var targetClass = $(this).attr('targetID')
    $('.vital_information').addClass('hidden')
    $('.customise_property').addClass('hidden')
    $('.veriant').addClass('hidden')
    // $('#vital_information').addClass('hidden')
    $('.'+targetClass).removeClass('hidden')
    $('.'+targetClass).addClass('show')
    // $('#Color').val(['18', '19']);
})

$(document).on('submit','#variantForm',function(e){
	e.preventDefault()
	// $('.setVariant').each((index,value)=>{
	// 	console.log($('.setVariant > option').attr('value'))
	// })
	var formData = $(this) .serialize()
	apply_busy_filter();
	$.ajax({
		method:'post',
		url:'/admin/stock/inventory/addWithVariant/',
		data:formData,
		success:function(res){
			$('#showCobination').html(res)
			remove_busy_filter();
		}

	})

})

$(document).on('submit','#customize_form',function(event){
	event.preventDefault()
	$.ajax({
		method:'post',
		url:'/admin/stock/inventory/saveCustomiseInventryDetail/',
		data:$('#customize_form').serialize(),
		success:function(res){
			alert(res)
		}
	})
})


$(document).on('submit','#getCustomeValues',function(event){
	event.preventDefault()
	var form = $('#getCustomeValues').serialize()
	
	getAttributeValue(form)
})

$(document).on('click','.showCutomise',function(){
	var id = $(this).attr('data-id')
	$('.attrVallContainer').addClass('hidden')
	$('.'+id).removeClass('hidden')
	$('.'+id).addClass('show')
})

function getValues(catId,ids,attrID='',attrSublistID='',isShow=''){
	apply_busy_filter();
	$.ajax({
		method:'post',
		url:'/admin/stock/inventory/getValuesOfCategory/',
		data:{catId:catId,ids:ids,attrID:attrID,attrSublistID:attrSublistID},
		success:function(res){
			// $('.showAttributeValuesOfCategory').addClass('hidden')
			// $('.showAttributeValuesOfCategory').removeClass('show')
			$('#val_'+ids).html(res)
			// if(res){
				if(isShow ==='' || isShow === true)
					$('#val_'+ids).removeClass('hidden')
					$('#val_'+ids).addClass('show')
				$('.saveButton').removeClass('hidden')
				$('.saveButton').addClass('show')
			// }		
			remove_busy_filter();
		}
	})
}

$(document).on('click','.getValuesOfCate',function(){
	var catId = $(this).val()	
	var ids = $(this).attr('data-id')	
	var checked = $("input[id=category_"+ ids + "]:checked").length;
   	console.log($("#category_"+ids).is(":checked"))
    if($("#category_"+ids).is(":checked")){
		getValues(catId,ids)
	}
	else{
		// alert('unchecked')
		$('.val_'+ids).remove()
		$('#val_'+ids).removeClass('show')
		$('#val_'+ids).addClass('hidden')
	}
})


$(document).ready(function(){
	var id = $('#CustomiseIds').attr('data-value');
	var array = $('#variantEditData').attr('data-array');
	array = JSON.parse(array)
	$.each(array,(index,value)=>{
		// $(value).each((index1,value1)=>{
			$('.'+index).val(value)
		// })
	})
	id =  id.split('%');
	$('.attributeCstom').val(id)
	$('#getCustomeValues').submit()
	$('#variantForm').submit()
})




//Explore Module JS
function getExploreTabsData(type){
	apply_busy_filter();
	$.ajax({
		method:'post',
		url:'explore/post',
		data:{type:type},
		success:function(res){
			$('.showContant').html(res)
			remove_busy_filter();
		}
	})
}


$(document).ready(function(){
	getExploreTabsData('post')
})
$(document).on('submit','#postForm',function(event){
	event.preventDefault()
	var formData = new FormData($(this)[0]);
	
	var  url = $(this).attr('action')
	$.ajax({
		method:'post',
		url:url,
		processData: false,
    	contentType: false,
		data:formData,
		success:function(res){
			location.reload()
			$('#massSelectArea').html(res)
			$('.close').click();
		}
	})
})

function filterProduct(type){
	$.ajax({
		method:'post',
		url:'explore/filter/',
		data:{type:type},
		success:function(res){
			$('#exploreProduct').html(res);
		}
	})
}

$(document).on('click','#tagButton',function(){
	if($('#categoryPost').hasClass('hidden')){
		$('#categoryPost').removeClass('hidden');
		$('#categoryPost').addClass('show');
	}
	else{
		$('#categoryPost').removeClass('show');
		$('#categoryPost').addClass('hidden');
	}
})

$(document).on('change','#caterory_id',function(){
	var id = $(this).val();

	$.ajax({
		method:'get',
		url:'explore/getProductByCategory/'+id,
		data:{id:id},
		success:function(res){
			$('#product_id').html(res);
		}
	})
})

$(document).on('click','.delete',function(){
	var url = $(this).attr('data-link')

	$.ajax({
		method:'post',
		url:url,
		success:function(res){
			$('#massSelectArea').html(res);			
		}
	})
})