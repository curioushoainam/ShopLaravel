<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    protected $table = 'bill_detail';

    public function bill(){
    	return $this->belongsTo('\App\Bill','id_bill','id');
    }

    public function billDetail(){
    	return $this->belongsTo('\App\Products','id_product','id');
    }
}
