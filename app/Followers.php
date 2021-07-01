<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $table = 'followers';
    protected $guarded = [];

    public function getFollowers(){
        return $this->belongsTo('App\Customer','customer_id');
    }
}
