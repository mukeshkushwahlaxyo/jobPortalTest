<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Common\Imageable;

class InventoryVariant extends Model
{
    use Imageable;
    
    protected $table = 'inventry_variant';
    protected $guarded = [];
}
