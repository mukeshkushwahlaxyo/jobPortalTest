<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Common\Imageable;

class MerchantProfile extends Model
{
    use Imageable;
    
    protected $table = 'merchant';
    protected $guarded = [];
}
