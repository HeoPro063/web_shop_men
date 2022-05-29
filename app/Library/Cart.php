<?php

namespace App\Library;
use App\Models\Promotion;
class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;
	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id, $qty){
		$cart = [];
		if($item->promotion_id){
			$promotion = Promotion::find($item->promotion_id);
			return $promotion->percent;
			$cart = ['qty'=> $qty, 'price' => $item->price, 'item' => $item];
		}
		else{
			$cart = ['qty'=> $qty, 'price' => $item->price, 'item' => $item];
		}

		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cart = $this->items[$id];
				$cart['qty'] += $qty;
			}
		}

		$cart['price'] = $cart['price'] * $cart['qty'];

		$this->items[$id] = $cart;
		$this->totalQty += $qty;
		$this->totalPrice += $cart['price'];
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
