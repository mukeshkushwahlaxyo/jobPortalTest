<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignerOption extends Model
{
    protected $table = 'option_designer';
    protected $guarded = [];

    public function getMerchant(){
        return $this->belongsTo('App\Merchant','marchent_id','id');
    }
}
