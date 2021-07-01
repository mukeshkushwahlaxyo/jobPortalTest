<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerReviews extends Model
{
    protected $table = 'customer_reviews';
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo('App\Customer','customer_id','id');
    }
}
