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
	$('.showAttributeValuesOfCategory').html('<div class="text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>')
	apply_busy_filter();
	$.ajax({
		method:'post',
		url:'/admin/stock/inventory/getValuesOfCategory/',
		data:{catId:catId,ids:ids,attrID:attrID,attrSublistID:attrSublistID},
		success:function(res){
			$('.showAttributeValuesOfCategory').addClass('hidden')
			$('.showAttributeValuesOfCategory').removeClass('show')
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
		$('.val_'+ids).remove()
		$('#val_'+ids).removeClass('show')
		$('#val_'+ids).addClass('hidden')
	}
})


$(document).ready(function(){
	var id = $('#CustomiseIds').attr('data-value');

	var array = $('#variantEditData').attr('data-array');
	if(array){
	array = JSON.parse(array)
		$.each(array,(index,value)=>{
			// $(value).each((index1,value1)=>{
				$('.'+index).val(value)
			// })
		})
	}
	
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
			
		},
		error: function(data){
	           remove_busy_filter();
	        //get the status code
	        if (data.status == 404) {
	        }
	        if (data.status == 500) {
	      		remove_busy_filter();
	        }
    	},
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
			// location.reload()
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

function getProductByCategory(catid,prodid=''){
	$.ajax({
		method:'get',
		url:'explore/getProductByCategory/'+catid+'/'+prodid,
		success:function(res){
			$('#product_id').html(res);
		}
	})
}
$(document).on('change','#caterory_id',function(){
	var id = $(this).val();

	getProductByCategory(id)
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

$(document).on('click','.deleteAny',function(){
	var url = $(this).attr('data-link')
	var referenceClass = $(this).attr('reference-class')
	$.ajax({
		method:'post',
		url:url,
		success:function(res){
			$('.'+referenceClass).html(res);			
		}
	})
})


function getDimention(order,group){
	var dimentionArray = ''
	if(order === '1' || order === '6'){
		if(	group ==='designer_group_1'){
			dimentionArray = '601x371'
		}
		if(	group ==='designer_group_2'){
			dimentionArray = '605x680'
		}
		if(	group ==='men_group_1'){
			dimentionArray = '393x580'
		}
		if(	group ==='men_group_2'){
			dimentionArray = '513x344'
		}
		if(	group ==='men_group_3'){
			dimentionArray = '360x225'
		}
		if(	group ==='offer_group_1'){
			dimentionArray = '605x810'
		}
	}

	else if(order === '2' || order === '4'){
		if(group ==='designer_group_1'){
			dimentionArray = '341x203'
		}
		if(group ==='designer_group_2'){
			dimentionArray = '620x402'
		}
		if(group ==='men_group_2'){
			dimentionArray = '709x344'
		}
		if(group ==='men_group_2' && order==='4' ){
			dimentionArray = '513x344'
		}
		if(	group ==='men_group_3'){
			dimentionArray = '360x225'
		}
		if(	group ==='offer_group_1'){
			dimentionArray = '605x810'
		}
	}

	else if(order === '3' || order === '5'){
		
		if(group ==='designer_group_1'){
			dimentionArray = '257x203'
		}
		if(group ==='designer_group_2'){
			dimentionArray = '620x272'
		}
		if(group ==='men_group_2'){
			dimentionArray = '711x344'
		}
		if(	group ==='men_group_3'){
			dimentionArray = '360x225'
		}
		if(	group ==='offer_group_1'){
			dimentionArray = '605x810'
		}
	}

	return dimentionArray
}
$(document).on('change','.order',function(){
	var order = $(this).val();
	var group = $('.gropus').val();

	var dimentionArray = getDimention(order,group)	
	  $('#sizeImage').text(`Image size should be `+dimentionArray)
})

$(".upload").change(function(e) {
    var file, img;

    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
            alert(this.width + " " + this.height);
        };
        img.onerror = function() {
            alert( "not a valid file: " + file.type);
        };
        img.src = _URL.createObjectURL(file);


    }

});

function getGroups(type,selected=''){
	$('.fa-spin').removeClass('hidden')
	$.ajax({
		method:'get',
		url:'banner/getGroups/'+type+'/'+selected,
		success:function(res){
			$('.gropus').html(res)
			$('.fa-spin').removeClass('show')
			$('.fa-spin').addClass('hidden')
			if(type === 'designer_home'){
				$('#designerHome').removeClass('hidden')
				$('#designerHome').addClass('show')
				$('#MenHome').addClass('hidden')
				$('#OfferHome').addClass('hidden')
				$('.defaultImg').addClass('hidden')
			}
			else if(type==='mens_home'){
				$('#MenHome').removeClass('hidden')
				$('#MenHome').addClass('show')
				$('#designerHome').addClass('hidden')
				$('#OfferHome').addClass('hidden')	
				$('.defaultImg').addClass('hidden')
			}
			else if(type==='offer_group'){
				$('#OfferHome').removeClass('hidden')
				$('#OfferHome').addClass('show')
				$('#designerHome').addClass('hidden')
				$('#MenHome').addClass('hidden')	
				$('.defaultImg').addClass('hidden')
			}
			else{
				$('.defaultImg').removeClass('hidden')
				$('.defaultImg').addClass('show')
			}

		}
	})
}

$(document).on('change','.group_type_id',function(){
	// gropus
	var type = $(this).val()
	getGroups(type)
})

function selectedProduct(status){
	if(status === '1'){
		$('.category').removeClass('col-md-6')
		$('.category').addClass('col-md-4')
		$('.Textile').removeClass('col-md-6')
		$('.Textile').addClass('col-md-4')
		$('.productList').removeClass('hidden')
		$('.productList').addClass('show')
	}else{
		$('.category').removeClass('col-md-4')
		$('.category').addClass('col-md-6')
		$('.Textile').removeClass('col-md-4')
		$('.Textile').addClass('col-md-6')
		$('.productList').removeClass('show')
		$('.productList').addClass('hidden')
	}
}

$(document).on('change','#isgroup',function(){
	var id = $(this).val()
	var status=$('#isgroup-'+id).attr('data-status')
	selectedProduct(status)
})

$(document).ready(function(){
	var id = $('#isgroup').val()
	var status=$('#isgroup-'+id).attr('data-status')
	selectedProduct(status)	
})
// $(document).ready(function(){
// 	$( "#sortable_wrapper div:nth-child(3)" ).addClass('mukesh')
// 	alert($( "#sortable_wrapper div:nth-child(3)" ).length)
// })