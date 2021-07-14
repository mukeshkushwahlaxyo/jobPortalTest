<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Followers extends Model
{
    use SoftDeletes;
    
    protected $table = 'followers';
    protected $guarded = [];

    public function getFollowers(){
        return $this->belongsTo('App\Customer','customer_id');
    }
}
