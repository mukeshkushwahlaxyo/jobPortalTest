<?php

namespace App;

use App\Attribute;
use App\AttributeSublist;
use Illuminate\Database\Eloquent\Model;

class InventoryVariantAttribute extends Model
{
    protected $table = 'inventory_variant_attributes';
    protected $guarded = [];

    public function attributeSublist()
    {
        return $this->hasMany(AttributeSublist::class,'id','attributeSublist_id');
    }

    public function attribute()
    {
        return $this->hasMany(Attribute::class,'id','attribute_id');
    }
}
