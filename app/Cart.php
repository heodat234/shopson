<?php
 
namespace App;

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

	public function add($item, $id,$quantity,$color,$inventory){
		$giohang = ['qty'=>0, 'price' => 0, 'item' => $item, 'color' => $color,'size' => 0,'inventory'=>0];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$giohang['inventory'] = $inventory;
		$giohang['size'] = $item->size;
		$giohang['color'] = $color;
		$giohang['qty'] += $quantity;
		$giohang['price'] = $item->export_price* $quantity;
		$this->items[$id] = $giohang;
		$this->totalQty += $quantity;
		$this->totalPrice += $giohang['price'];
	}
	//giảm 1
	public function reduceByOne($id){ 
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']->export_price;
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']->export_price;
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
		if($this->totalQty<=0){
			unset($this->totalPrice);
		}
	}
	//tăng 1
	public function riseByOne($id){ 
		$this->items[$id]['qty']++;
		// if ($this->items[$id]['qty'] > $this->items[$id]['inventory']) {
		// 	$this->items[$id]['qty'] = $this->items[$id]['inventory'];
		// 	$this->items[$id]['price'] = $this->items[$id]['price'];
		// 	$this->totalPrice = $this->totalPrice;
		// }else{
			$this->items[$id]['price'] += $this->items[$id]['item']->export_price;
			$this->totalQty++;
			$this->totalPrice += $this->items[$id]['item']->export_price;
			if($this->items[$id]['qty']<=0){
				unset($this->items[$id]);
			}
			if($this->totalQty<=0){
				unset($this->totalPrice);
			}
		// }
		
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
