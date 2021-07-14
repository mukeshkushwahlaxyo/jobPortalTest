<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionCategory extends Model
{
    protected $table = 'option_category';
    protected $guarded = [];

    public function getCategory(){
        return $this->belongsTo('App\Category','category_id','id');
    }
}
