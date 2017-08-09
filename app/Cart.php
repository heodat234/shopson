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
		$giohang = ['id'=>0,'qty'=>0, 'price' => 0, 'item' => $item, 'color' =>0,'size' => 0,'inventory'=>0];
		if ($this->items) {
			for ($i=0; $i < count($this->items); $i++) { 
				// dd($this->items[$i]['color']);
				// dd($this->items[$i]['item']->idsize);
				if ($id == $this->items[$i]['item']->idsize && $color== $this->items[$i]['color'] ) {

					$giohang = $this->items[$i];
					$giohang['inventory'] = $inventory;
					$giohang['qty'] += $quantity;
					$giohang['price'] = $item->export_price* $giohang['qty'];
					$this->items[$i] = $giohang;
					$this->totalQty += $quantity;
					$this->totalPrice += $item->export_price* $quantity;
					break;
				}
				if($i == count($this->items)-1 ){
					$giohang['id'] = $i+1;
					$giohang['inventory'] = $inventory;
					$giohang['size'] = $item->size;
					$giohang['color'] = $color;
					$giohang['qty'] = $quantity;
					$giohang['price'] = $item->export_price* $giohang['qty'];
					$this->items[count($this->items)] = $giohang;
					$this->totalQty += $quantity;
					$this->totalPrice += $item->export_price* $quantity;
					break;
				}
			}
		}else{
			$giohang['id'] = 0;
			$giohang['inventory'] = $inventory;
			$giohang['size'] = $item->size;
			$giohang['color'] = $color;
			$giohang['qty'] = $quantity;
			$giohang['price'] = $item->export_price* $giohang['qty'];
			$this->items[0] = $giohang;
			$this->totalQty += $quantity;
			$this->totalPrice += $item->export_price* $quantity;
		}
		
		
	}
	//giảm 1
	public function reduceByOne($id){ 
				$this->items[$id]['qty']--;
				$this->items[$id]['inventory']++;
				$this->items[$id]['price'] -= $this->items[$id]['item']->export_price;
				$this->totalQty--;
				$this->totalPrice -= $this->items[$id]['item']->export_price;
				$export_qty =Export_Product::Sub_Export_Quantity($this->items[$id]['item']->idsize,1);
				if($this->items[$id]['qty']<=0){
					unset($this->items[$id]);
				}
				if($this->totalQty<=0){
					unset($this->totalPrice);
				}
		
	}
	//tăng 1
	public function riseByOne($id){ 
				$qty_import = Import_Product::Qty_Import_Product_By_Id($this->items[$id]['item']->id,$this->items[$id]['size']);
				$qty_export = Export_Product::Export_Quantity($this->items[$id]['item']->idsize)->first();
				$this->items[$id]['inventory'] = $qty_import - $qty_export->export_quantity;
				if ($this->items[$id]['inventory'] <=0) {
					$this->items[$id]['qty'] = $this->items[$id]['qty'];
					$this->items[$id]['price'] = $this->items[$id]['price'];
					$this->totalPrice = $this->totalPrice;
					$this->items[$id]['inventory']--;
				}else{
					$this->items[$id]['qty']++;
					$this->items[$id]['inventory']--;
					$this->items[$id]['price'] += $this->items[$id]['item']->export_price;
					$this->totalQty++;
					$this->totalPrice += $this->items[$id]['item']->export_price;
					$export_qty =Export_Product::Add_Export_Quantity($this->items[$id]['item']->idsize,1);
					if($this->items[$id]['qty']<=0){
						unset($this->items[$id]);
					}
					if($this->totalQty<=0){
						unset($this->totalPrice);
					}
				}
		
	}
	//xóa nhiều
	public function removeItem($id){
				$this->totalQty -= $this->items[$id]['qty'];
				$this->totalPrice -= $this->items[$id]['price'];
				$export_qty =Export_Product::Sub_Export_Quantity($this->items[$id]['item']->idsize,$this->items[$id]['qty']);
				unset($this->items[$id]);
	}
}
