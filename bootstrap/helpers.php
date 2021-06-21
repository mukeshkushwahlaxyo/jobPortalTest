<?php

use App\InventoryCustomise;
use App\InventoryVariantAttribute;
use App\InventoryVariant;

if(!function_exists('getAttributeIds')){
	function getAttributeIds($inventory){
		$attrID = '';
		$cont = 1;
		foreach($inventory->getCustomise as $getCustomise){

			$strID = (string)$getCustomise->attribute_id ;
			$strsublistID = (string)$getCustomise->attributeSublist_id ;
			if($cont === 1){
				$attrID .= $strID.','.$strsublistID;
			}
			else{				
				$attrID .= '%'.$strID.','.$strsublistID;
			}

			$cont++;
    	}
    
    	return $attrID;
	}
}

if(!function_exists('getSelectedTabs')){
	function getCategoryTabs($attrID,$attrSublistID){
		$cat = InventoryCustomise::select('category_id');
		if($attrSublistID!==''){
			$cat->where('attributeSublist_id',$attrSublistID);
		}
		$data = $cat->where('attribute_id',$attrID)->where('inventories_id',session('invoiceId'))->get();
		$catID = [];
		 foreach($data as $Data){
		 	$catID[] = $Data->category_id;
		 }
		 return $catID;
	}
}

if(!function_exists('getVariant')){
	function getVariant($inventoryId){
		return InventoryVariant::where('inventroy_id',$inventoryId)->get();
	}
}
if(!function_exists('getSelectedVariantAttrValue')){
	function getSelectedVariantAttrValue($variantID){
		$variant = InventoryVariantAttribute::with(['attribute'])->select('attribute_id','attributeValue_id')->where('variant_id',$variantID)->get();
		$data = [];
		foreach($variant as $Variant){
			$data['val_'.$Variant->attribute_id] = $Variant->attributeValue_id;
		}
	
		 return $data;
	}
}

?>