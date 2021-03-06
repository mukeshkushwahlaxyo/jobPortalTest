<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends BaseModel
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attribute_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'shop_id',
                    'value',
                    'price',
                    'quality',
                    'quantity',
                    'status',
                    'description',
                    'color',
                    'attribute_id',
                    'category_id',
                    'updated_id',
                    'attribute_sublist_id',
                    'order',
                ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the attribute for the AttributeValue.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeSublist()
    {
        return $this->belongsTo(AttributeSublist::class,'attribute_sublist_id','id');
    }

    /**
     * Get the inventories for the supplier.
     */
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'attribute_inventory')
                    ->withPivot('attribute_id')
                    ->withTimestamps();
    }
    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }

    public function getShopName(){
        return $this->belongsTo(Shop::class,'shop_id');
    }

    public function getCategoryName(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
