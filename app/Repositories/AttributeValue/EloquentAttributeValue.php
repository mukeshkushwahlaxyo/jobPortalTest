<?php

namespace App\Repositories\AttributeValue;

use App\Attribute;
use App\AttributeValue;
use App\AttributeSublist;
use App\Category;
use Illuminate\Http\Request;
// use App\Http\Requests\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Auth;

class EloquentAttributeValue extends EloquentRepository implements BaseRepository, AttributeValueRepository
{
	protected $model;

	public function __construct(AttributeValue $attributeValue)
	{
		$this->model = $attributeValue;
	}

    public function create($id = null)
    {
        return $id ? Attribute::find($id) : null;
   }

    public function store(Request $request)
    {
        // dd(parent::all());
        $attribute = parent::store($request);

       if ($request->hasFile('image')) {
            $attribute->saveImage($request->file('image'));
       }

        return $attribute;
    }

   public function update(Request $request, $id)
    {
        $isUpdate = AttributeValue::find($id);
        if(Auth::user()->role->name === 'Merchant' && $isUpdate->shop_id == null){
            $data = $request->all();
            $data['updated_id'] = $id;
            $data['shop_id'] = Auth::user()->shop_id;
            $attribute = AttributeValue::create($data);
        }
        else{
            $attribute = parent::update($request, $id);    
        }

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)) {
            $attribute->deleteImage();
        }

        if ($request->hasFile('image')) {
            $attribute->saveImage($request->file('image'));
        }

        return $attribute;
    }

    public function getAttribute($id)
    {
        return Attribute::findOrFail($id);
    }

    public function destroy($id)
    {
        $attribute = parent::findTrash($id);

        $attribute->flushImages();

        return $attribute->forceDelete();
    }

    public function massDestroy($ids)
    {
        $attributes = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($attributes as $attribute) {
            $attribute->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $attributes = $this->model->onlyTrashed()->get();

        foreach ($attributes as $attribute) {
            $attribute->flushImages();
        }

        return parent::emptyTrash();
    }

    public function reorder(array $attributeValues)
    {
        foreach ($attributeValues as $id => $order) {
            $this->model->findOrFail($id)->update(['order' => $order]);
        }

        return true;
    }

    public function getAllAttributeList(){
        return Attribute::all();
    }

    public function getAttributeSubList($attributeId){
        $data['sublist'] = AttributeSublist::where('attribute_id',$attributeId)->get();
        $data['isCustom'] = Attribute::find($attributeId);
        return ($data); 
    }

    public function allAttribute(){
        return Attribute::with(['productType'])->get();
    }

}