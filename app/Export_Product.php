<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Export_Product extends Model
{
    protected $table='export_product';

    public static function Find_Export_Product($id)
    {
    	$ex_pro = DB::table('export_product')->select()->where('id',$id);
    	return $ex_pro;
    }
    public static function FindProductByIdPro_Size($idsize)
    {
    	$product=DB::table('export_product')
    				->where('export_product.id',$idsize)
    				->join('products','export_product.id_product','=','products.id')
    				->select('export_product.id as idsize','products.id','products.name','products.image','export_product.size','export_product.export_price','export_product.export_quantity');
    	return $product;
    }
    public static function Add_Export_Quantity($idsize,$quantity)
    {
        $qty = DB::table('export_product')
                    ->where('id',$idsize)
                    ->increment('export_quantity',$quantity);
        return $qty;
    }
    public static function Sub_Export_Quantity_Admin($idPro,$size,$quantity)
    {
        $qty = DB::table('export_product')
                    ->where('id_product',$idPro)
                    ->where('size','LIKE','%'.$size.'%')
                    ->decrement('export_quantity',$quantity);
        return $qty;
    }
    public static function Sub_Export_Quantity($idsize,$quantity)
    {
        $qty = DB::table('export_product')
                    ->where('id',$idsize)
                    ->decrement('export_quantity',$quantity);

        return $qty;
    }
    //lấy số lượng bán ra theo từng loại
    public static function Export_Quantity($idsize)
    {
        $qty = DB::table('export_product')
                    ->where('id',$idsize)
                    ->select('export_quantity');
        return $qty;
    }
    public static function Export_Quantity_By_IdProduct($id_product,$size)
    {
        $qty = DB::table('export_product')
                    ->where([['id_product',$id_product],['size',$size]])
                    ->select('export_quantity');
        return $qty;
    }
    //Lúc nhập hàng hoặc thêm kích thước
    public static function  Update_Insert_Export_Product($id,$size,$export_price)
    {
        $pro=DB::table('export_product')
                ->whereRaw("id_product ='$id' and size REGEXP'$size' ")->first();
        if(!isset($pro))
            $pro=DB::table('export_product')->insert(['id_product'=>$id,'size'=>$size,'export_price'=>$export_price]);
        else
            $pro=DB::table('export_product')
                ->whereRaw("id_product ='$id' and size REGEXP'$size' ")->update(['export_price'=>$export_price]);

    }
    //cập nhập lại giá bán cho từng loại size
    public static function Updete_Export_Price($id,$price)
    {
        $pro = DB::table('export_product')
                    -> where('id',$id)
                    ->update(['export_price'=>$price]);
    }

    public static function Find_Export_By_Product($id_product)
    {
         $pro=DB::table('export_product')->where('id_product','=',$id_product)->select();
         return $pro;
    }
    public static function Delete_Export($id)
    {
         $pro=DB::table('export_product')->where('id','=',$id)->update(['status'=>1]);
    }
}
