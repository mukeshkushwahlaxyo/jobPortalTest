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
    protected $fillable = ['title', 'description','shop_id','slug'];
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
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
