<?php

namespace App\Library;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
class Cart
{
	public $items = [];
	public $totalQty = 0;
	public $totalPrice = 0;
	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart['items'];
			$this->totalQty = $oldCart['totalQty'];
			$this->totalPrice = $oldCart['totalPrice'];
		}
	}

	public function add($product, $data, $qty){
		$cart = [];
		if($product->promotion_id && $data['status_promotion'] == 1){
			$promotion = Promotion::find($product->promotion_id);
			$percent= $promotion->percent;
			$percent = $percent / 100;
			$price_promotion = $percent * $product->price;
			$promotion_pr =  $product->price - $price_promotion;
			$cart = ['qty'=> $qty, 'price' => $promotion_pr, 'item' => $product, 'color_id' => $data['color_id'], 'size_id' => $data['size_id']];
		}
		else{
			$cart = ['qty'=> $qty, 'price' => $product->price, 'item' => $product, 'color_id' => $data['color_id'], 'size_id' => $data['size_id']];
		}
		$id = $data['id'].''.$data['color_id'].''.$data['size_id'];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				foreach($this->items as $item){
					if($data['color_id'] == $item['color_id'] && $data['size_id'] == $item['size_id']) {
						$cart = $this->items[$id];
						$cart['qty'] += $qty;
						$this->totalPrice -= $item['price'];
					}
				}
			}
		}
		if($product->promotion_id && $data['status_promotion'] == 1){
			$promotion = Promotion::find($product->promotion_id);
			$percent= $promotion->percent;
			$percent = $percent / 100;
			$price_promotion = $percent * $product->price;
			$promotion_pr =  $product->price - $price_promotion;
			$cart['price'] = $promotion_pr * $cart['qty'];
		}else {
			$cart['price'] = $product->price * $cart['qty'];
		}
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

	public function getCart() {

		$datas = [];
		$datas['items'] = $this->items;
		$datas['totalQty'] = $this->totalQty;
		$datas['totalPrice'] = $this->totalPrice;

		$datas['status'] = 1;
		foreach($this->items as $key => $value) {
			$product = Product::find($value['item']['id']);
			if($product) {
				$datas['items'][$key]['name'] = $product->name;
				$imagesProduct = $product->ImageProducts()->get();
			   	$datas['items'][$key]['image'] = $imagesProduct[0]->name;
				$color = Color::find($value['color_id']);
				$datas['items'][$key]['color'] = $color->name;
				$size = Size::find($value['size_id']);
				$datas['items'][$key]['size'] = $size->name;
			}else{
				$datas['status'] = 0;
			}
		}
		return  $datas;
	}

	public function getCartBase() {
		return [
			'items' => $this->items,
			'totalQty' => $this->totalQty,
			'totalPrice' => $this->totalPrice,
		];
	}
}
