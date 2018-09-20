<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customer';

    public function bills(){
    	return $this->hasMany('\App\Bills','id_customer','id');
    }

    public function billDetails(){
    	return $this->hasManyThrough('\App\Bills','\App\Bill_detail','id_customer','id_bill','id');		// source, go-between, id_source, id_go-between, id
    }
}
