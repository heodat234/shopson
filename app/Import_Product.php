<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Import_Product extends Model
{
    protected $table='import_product';
    //tổng số lượng nhập theo từng sản phẩm
    public static function Qty_Import_Product_By_Id($idProduct, $size)
    {
    	$im_qty = DB::table('import_product')
                ->where('id_product',$idProduct)
                ->where('size',$size)
                ->sum('import_quantity');
    	return $im_qty;
    }


    public static function Insert_Import_Product($id,$size,$import_price,$import_quantity)
    {
            $pro=DB::table('import_product')->insert(['id_product'=>$id,'size'=>$size,'import_price'=>$import_price,'import_quantity'=>$import_quantity]);
    }

    public static function Edit_Import($id,$qty,$price)
    {
        $pro = DB::table('import_product')->where('id',$id)->update(['import_price'=>$price,'import_quantity'=>$qty]);
    }

    
    public static function Show_Import_Product_All()
    {
        $pro=DB::table('import_product')
                ->join('products','products.id','=','import_product.id_product')
                ->select('products.name','import_product.size','import_product.id','import_product.import_price','import_product.import_quantity','import_product.created_at');
        return $pro;
    }
    //tính tổng tiền nhập và số lượng nhập
    public static function Sum_Import()
    {
        $Sum_import = DB::table('import_product')
                ->join('products','products.id','=','import_product.id_product')
                ->select('id_product','size','products.name', DB::raw('SUM(import_price) as price, SUM(import_quantity) as qty '))
                ->groupBy('id_product','size','products.name')->get();
        return $Sum_import;
    }
    // public static function Select_Size_By_IdProduct($idPro)
    // {
    //     $size = DB::table('import_product')->where('id_product',$idPro)->where('size');
    // }



    //tìm imort product theo id
    public static function Find_Import_By_Id($id)
    {
        $pro = DB::table('import_product')->where('import_product.id',$id)
                    ->join('products','products.id','=','import_product.id_product')
                    ->select('import_product.id','import_product.size','import_product.import_price','import_product.import_quantity','products.name');
        return $pro;
    }
    
    
    public static function Find_Import_By_IdPro($idPro,$size)
    {
        $size = DB::table('import_product')->where([['id_product',$idPro],['size',$size]])->orderBy('id','DESC')->select();
        return $size;
    }
    
    
}
