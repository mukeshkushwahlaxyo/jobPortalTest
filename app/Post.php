<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Common\Imageable;

class Post extends Model
{
    use SoftDeletes ,Imageable;
    protected $table = 'post';
    protected $dates = ['deleted_at'];
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
   
    /**
     * The has Many Relationship
     *
     * @var array
     */

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function share()
    {
        return $this->hasMany(Share::class,'post_id','id');
    }

    public function like()
    {
        return $this->hasMany(Like::class,'post_id','id');
    }
}
