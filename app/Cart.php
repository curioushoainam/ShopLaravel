<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	public $items = null;	// products
	public $amount = 0;		// total of money of all items in the cart
	public $total = 0;		// total of quantity of all items in the cart
	public $count = 0;		// number of the product's name in the cart

	function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->amount = $oldCart->amount;
			$this->total = $oldCart->total;
		}
	}

	function add($item, $id){
			$cart = ['qty'=>0, 'subamount' => 0, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cart = $this->items[$id];
			}
		}
		$cart['qty']++;
		if($item->promotion_price)
			$cart['subamount'] = $item->promotion_price * $cart['qty'];
		else
			$cart['subamount'] = $item->unit_price * $cart['qty'];

		$this->items[$id] = $cart;
				
		$this->amount = 0;
		foreach($this->items as $id => $cart){
			$this->amount += $cart['subamount'];
		}			
		$this->total++;
		$this->count = count($this->items);		
	}

	function removeItem($id){
		$this->total -= $this->items[$id]['qty'];
		unset($this->items[$id]);
		$this->amount = 0;
		foreach($this->items as $id => $cart){
			$this->amount += $cart['subamount'];
		}	
		$this->count = count($this->items);
	}

}
