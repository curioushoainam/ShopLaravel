<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    public function billDetails(){
    	return $this->hasMany('\App\Bill_detail','id_product','id');
    }

    public function typeProduct(){
    	return $this->belongsTo('\App\Type_products','id_type','id');
    }
}
