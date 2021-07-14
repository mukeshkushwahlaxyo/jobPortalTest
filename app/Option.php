<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';
    protected $guarded = [];

    public function getOptions(){
        return $this->hasMany('App\OptionCategory','option_id','id');
    }

    public function getCategory(){
        return $this->hasManyThrough(Category::class , OptionCategory::class)
    }

}
