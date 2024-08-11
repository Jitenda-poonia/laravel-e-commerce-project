<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuoteItem extends Model
{
    protected $guarded = [];

    function produts(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
