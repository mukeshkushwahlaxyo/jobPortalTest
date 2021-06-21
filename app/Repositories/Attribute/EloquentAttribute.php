<?php

namespace App\Repositories\Attribute;

use Auth;
use App\Attribute;
use App\AttributeType;
use App\AttributeValue;
use App\AttributeSublist;
use App\ProductType;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentAttribute extends EloquentRepository implements BaseRepository, AttributeRepository
{
	protected $model;

	public function __construct(Attribute $attribute)
	{
		$this->model = $attribute;
	}

	public function all()
	{
        // dd(Auth::user()->isFromPlatform());
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->with(['attributeType','productType'])->withCount('attributeValues')->get();
        }

        return $this->model->with(['attributeType','productType'])->withCount('attributeValues')->get();
	}


	public function trashOnly()
	{
        if (! Auth::user()->isFromPlatform()) {
            return $this->model->mine()->onlyTrashed()->with('attributeType')->get();
        }

		return $this->model->onlyTrashed()->with('attributeType')->get();
	}

    public function entities($id)
    {
        $entities['attribute'] = parent::find($id);
        $entities['attribute']->attributeValues()->with(['image'])->get();
        // dd(parent::find($id)->attributeValues()->get());

        $entities['attributeValues'] = $entities['attribute']->attributeValues()->with(['image','getShopName.owner'])->get();

        $entities['trashes'] = $entities['attribute']->attributeValues()->onlyTrashed()->get();

        $updated_id =  AttributeValue::select('updated_id')
                        ->where('shop_id', Auth::user()->shop_id)
                        ->where('updated_id','!=',null)
                        ->get();
        $ids=[];                
        foreach($updated_id as $Id){
            $ids[] = $Id->updated_id; 
        }    

        $entities['updated_id'] =$ids;             

        return $entities;
    }

    public function reorder(array $attributes)
    {
        foreach ($attributes as $id => $order) {
            $this->model->findOrFail($id)->update(['order' => $order]);
        }

        return true;
    }

    public function getAttributeTypeId($attribute)
    {
        return $this->model->findOrFail($attribute)->attribute_type_id;
    }

    public function destroy($attribute)
    {
        if(! $attribute instanceof Attribute) {
            $attribute = parent::findTrash($attribute);
        }

        $attributeValues = $attribute->attributeValues()->get();

        foreach ($attributeValues as $entity) {
            $entity->deleteImage();
        }

        return $attribute->forceDelete();
    }

    public function getProductType(){
        return ProductType::all();
    }

    public function getAttributeType($id){
        return AttributeType::where('product_type_id',$id)->get();
    }

    public function saveDataOfSublist($data,$attributeId){
            // dd($attributeId);
        foreach ($data as $key => $value) {
            $sublist = [
                'attribute_id'=> $attributeId,
                 'name'=> $value  
            ];
            AttributeSublist::create($sublist);
        }
    }

    public function find($id){
        $edittable = Attribute::with(['attributeSublist'])->find($id);
        return $edittable;
    }

    public function deleteSublist($id){
        $edittable = AttributeSublist::destroy($id);      
    }

    public function deleteSublistForAttribute($id){
        AttributeSublist::where('attribute_id',$id)->delete();
    }


    public function getMarchentUpdatedId(){
        return AttributeValue::select('updated_id')
                           ->where('shop_id', Auth::user()->shop_id)
                           ->where('updated_id','!=',null)
                           ->get();
    }
}