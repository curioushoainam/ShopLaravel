<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $table = 'bills';

    public function customer(){
    	return $this->belongsTo('\App\Customer','id_customer','id');
    }

    public function billDetails(){
    	return $this->hasMany('\App\Bill_detail','id_bill','id');
    }
}
