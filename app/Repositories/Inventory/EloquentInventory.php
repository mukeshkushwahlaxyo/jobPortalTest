<?php

namespace App\Repositories\Inventory;

use Auth;
use App\Product;
use App\Inventory;
use App\InventoryProduct;
use App\InventoryVariant;
use App\InventoryVariantAttribute;
use App\InventoryCustomise;
use App\Attribute;
use App\AttributeValue;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentInventory extends EloquentRepository implements BaseRepository, InventoryRepository
{
	protected $model;

	public function __construct(Inventory $inventory)
	{
		$this->model = $inventory;
	}

    public function all($status = null)
    {
        $inventory = $this->model->with('product', 'image');
        switch ($status) {
            case "active":
                $inventory = $inventory->where('active', 1);
                break;

            case "inactive":
                $inventory = $inventory->where('active', 0);
                break;

            case "outOfStock":
                $inventory = $inventory->where('stock_quantity', '<=', 0);
                break;
        }

        if (! Auth::user()->isFromPlatform()) {
            return $inventory->mine()->get();
        }

        return $inventory->get();
    }

 
    public function trashOnly()
    {
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->onlyTrashed()->with('product', 'image')->get();
        }

        return $this->model->onlyTrashed()->with('product', 'image')->get();
    }

    public function checkInventoryExist($productId)
    {
        return $this->model->mine()->where('product_id', $productId)->first();
    }

    public function store(Request $request)
    {
        $inventory = parent::store($request);

        $this->setAttributes($inventory, $request->input('variants'));

        if ($request->input('packaging_list')) {
            $inventory->packagings()->sync($request->input('packaging_list'));
        }

        if ($request->input('tag_list')) {
            $inventory->syncTags($inventory, $request->input('tag_list'));
        }

        if ($request->hasFile('image')) {
            $inventory->saveImage($request->file('image'));
        }

        return $inventory;
    }

    public function find($id){
        return Inventory::with(['getCustomise.attributeSublist','getCustomise.attribute','getVariant','inventoryProduct'])->find($id);
    }

    public function storeWithVariant(Request $request)
    {   
        $product = json_decode($request->input('product'));
       
        $skus = $request->input('sku');

        $conditions = $request->input('condition');

        $stock_quantities = $request->input('stock_quantity');

        $purchase_prices = $request->input('purchase_price');

        $sale_prices = $request->input('sale_price');

        $offer_prices = $request->input('offer_price');

        $images = $request->file('image');

        // Relations
        $packaging_lists = $request->input('packaging_list');

        $tag_lists = $request->input('tag_list');

        $variants = $request->input('variants');

        //Preparing data and insert records.
        $dynamicInfo = [];
        foreach ($skus as $key => $sku) {
            $dynamicInfo['sku'] = $skus[$key];

            $dynamicInfo['product_id'] = $product->id;

            $dynamicInfo['shop_id'] = $request->input('shop_id');

            $dynamicInfo['user_id'] = $request->input('user_id');

            $dynamicInfo['inventroy_id'] = $request->input('inventry_id');

            $dynamicInfo['condition'] = $conditions[$key];

            $dynamicInfo['stock_quantity'] = $stock_quantities[$key];

            $dynamicInfo['purchase_price'] = $purchase_prices[$key];

            $dynamicInfo['sale_price'] = $sale_prices[$key];

            $dynamicInfo['offer_price'] = ($offer_prices[$key]) ? $offer_prices[$key] : NULL ;

            $dynamicInfo['offer_start'] = ($offer_prices[$key]) ? $request->input('offer_start') : NULL ;

            $dynamicInfo['offer_end'] = ($offer_prices[$key]) ? $request->input('offer_end') : NULL ;

            // $dynamicInfo['slug'] = Str::slug($request->input('slug') . ' ' . $sku, '-');

            // Merge the common info and dynamic info to data array
            // $data = array_merge($dynamicInfo, $commonInfo);

            // Insert the record
            $inventory = InventoryVariant::create($dynamicInfo);

        // dd($inventory);
            // Sync Attributes
            if ($variants[$key]) {
                $this->saveVariants($variants[$key],$inventory->id);
            }

            // Sync packaging
            if ($packaging_lists) {
                $inventory->packagings()->sync($packaging_lists);
            }

            // Sync tags
            if ($tag_lists) {
                $inventory->syncTags($inventory, $tag_lists);
            }

            // Save Images
            if (isset($images[$key])) {
                $inventory->saveImage($images[$key]);
            }
        }

        return true;
    }

    public function saveVariants($variants,$inventryId){
        foreach($variants as $key => $Variants){
            // dd($Variants);
            $variantsData['attribute_id'] = $key;
            $variantsData['attributeValue_id'] = $Variants;
            $variantsData['variant_id'] = $inventryId;
            InventoryVariantAttribute::create($variantsData);
        }            
    }

    public function updateQtt(Request $request, $id)
    {
        $inventory = parent::find($id);

        $inventory->stock_quantity = $request->input('stock_quantity');

        return $inventory->save();
    }

    public function update(Request $request, $id)
    {
        $inventory = parent::update($request, $id);
        InventoryProduct::where('inventory_id',$id)->delete();
        if(isset($request->products_id)){
            foreach($request->products_id as $key => $products){
                $data['inventory_id'] = $id;
                $data['product_id'] = $products;
                InventoryProduct::create($data);
            }
        }

        $this->setAttributes($inventory, $request->input('variants'));

        $inventory->packagings()->sync($request->input('packaging_list', []));

        $inventory->syncTags($inventory, $request->input('tag_list', []));

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)) {
            $inventory->deleteImage();
        }

        if ($request->hasFile('image')) {
            $inventory->saveImage($request->file('image'));
        }

        return $inventory;
    }

    public function destroy($inventory)
    {
        if (! $inventory instanceof Inventory) {
            $inventory = parent::findTrash($inventory);
        }

        $inventory->detachTags($inventory->id, 'inventory');

        $inventory->flushImages();

        return $inventory->forceDelete();
    }

    public function massDestroy($ids)
    {
        $inventories = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($inventories as $inventory) {
            $inventory->detachTags($inventory->id, 'inventory');
            $inventory->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $inventories = $this->model->onlyTrashed()->get();

        foreach ($inventories as $inventory) {
            $inventory->detachTags($inventory->id, 'inventory');
            $inventory->flushImages();
        }

        return parent::emptyTrash();
    }

    public function findProduct($id)
    {
        return Product::with(['categories'=>function($query){
             $query->select('id','name');
        }])->findOrFail($id);
    }

    public function inventoryCategory($id){
     return Inventory::with(['category'=>function($query){
             $query->select('id','name');
        }])->findOrFail($id);   
    }

    public function customiseCategory(){
        return Category::where('type',1)->get();
    }

    public function getCustomiseCategory(){
        return Category::where('type',1)->get();
    }
    /**
     * Set attribute pivot table for the product variants like color, size and more
     * @param obj $inventory
     * @param array $attributes
     */
    public function setAttributes($inventory, $attributes)
    {
        $attributes = array_filter($attributes ?? []);        // remove empty elements

        $temp = [];
        foreach ($attributes as $attribute_id => $attribute_value_id) {
            $temp[$attribute_id] = ['attribute_value_id' => $attribute_value_id];
        }
        if (! empty($temp)) {
            $inventory->attributes()->sync($temp);
        
        }

        return true;
    }

    public function getAttributeList(array $variants)
    {
        return Attribute::find($variants)->pluck('name', 'id');
    }

    /**
     * Check the list of attribute values and add new if need
     * @param  [type] $attribute
     * @param  array  $values
     * @return array
     */
    public function confirmAttributes($attributeWithValues)
    {
        $results = array();
        // dd($attributeWithValues);
        unset($attributeWithValues['product_id']);

        foreach ($attributeWithValues as $attribute => $values) {
            foreach ($values as $value) {
                $oldValueId = AttributeValue::find($value);

                $oldValueName = AttributeValue::where('value', $value)->where('attribute_id', $attribute)->first();

                if ($oldValueId || $oldValueName) {
                    $results[$attribute][($oldValueId) ? $oldValueId->id : $oldValueName->id] = ($oldValueId) ? $oldValueId->value : $oldValueName->value;
                }
                else{
                    // if the value not numeric thats meaninig that its new value and we need to create it
                    $newID = AttributeValue::insertGetId(['attribute_id' => $attribute, 'value' => $value]);

                    $newAttrValue = AttributeValue::find($newID);

                    $results[$attribute][$newAttrValue->id] = $newAttrValue->value;
                }
            }
        }

        return $results;
    }

    public function getAllAttribute($id=''){

        if($id !=''){
            return Attribute::with(['attributeValues','attributeSublist'])->where('product_type',$id)->get();
        }
        return Attribute::with(['attributeValues','attributeSublist'])->get();
    }

    public function getAttributeValues($attrID,$attrValurID=''){
        // dd($attrID);
        $attrValue = AttributeValue::with('image')->where('shop_id',Auth::user()->shop_id);

        if($attrValurID !=''){
            $attrValue->where('attribute_sublist_id',$attrValurID);
        }

        $result = $attrValue->where('attribute_id',$attrID)->get();
        return $result;
    }

    public function getAttributeAndSublist($attrID,$attrValurID=''){
        // dd($attrID);
        $attrValue = AttributeValue::with(['attribute','attributeSublist'])->select('attribute_id','attribute_sublist_id')->where('shop_id',Auth::user()->shop_id);

        if($attrValurID !=''){
            $attrValue->where('attribute_sublist_id',$attrValurID);
        }

        $result = $attrValue->where('attribute_id',$attrID)->groupBy('attribute_id')->get();
        return $result;
    }
  

    public function InventoryInCustomise($id){
        $isAvaiilable = InventoryCustomise::where('inventories_id',$id)->get();
        
        if(count($isAvaiilable)){
            InventoryCustomise::where('inventories_id',$id)->delete();
        } 
    }

    public function saveCutomiseInentryData($data){       
       InventoryCustomise::create($data);
       return true;
    }

    public function getSelectedValue($attrID,$attrSublistID){
        
       $data = InventoryCustomise::where('attribute_id',$attrID)->where('inventories_id',session('invoiceId'));       
        if($attrID !==null){
            $data->where('attributeSublist_id',$attrSublistID);            
        }
        $data = $data->get();
        return $data;
    }   

    public function getValuesOfCategory($id){
        $data = AttributeValue::with(['image'])->where('category_id',$id)->get();        
        return $data;
    } 

    public function getVariants($inventoryId){
        return InventoryVariant::with('image')->where('inventroy_id',$inventoryId)->get();
    }

    public function getCategory($id){
        return Category::find($id);
    }
}