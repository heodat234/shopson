<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Import_Product extends Model
{
    protected $table='import_product';

    public static function Qty_Import_Product_By_Id($idProduct, $size)
    {
    	$im_qty = DB::table('import_product')
                ->where('id_product',$idProduct)
                ->where('size',$size)
                ->sum('import_quantity');
    	return $im_qty;
    }
    // public static function FindProductByIdPro_Size($idsize)
    // {
    // 	$product=DB::table('export_product')
    // 				->where('export_product.id',$idsize)
    // 				->join('products','export_product.id_product','=','products.id')
    // 				->select('export_product.id as idsize','products.id','products.name','products.image','export_product.size','export_product.export_price');
    // 	return $product;
    // }
    // public static function Update_Export_Quantity($idProduct,$size,$quantity)
    // {
    //     $qty = DB::table('export_product')
    //                 ->where('id_product',$idProduct)
    //                 ->where('size',$size)
    //                 ->increment('export_quantity',$quantity);
    //     return $qty;
    // }
    
}
