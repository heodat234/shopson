<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class Product extends Model
{
    protected $table='products';
    public function type_products(){
    	return $this->belongsTo('App\TypeProduct','id_type','id');
    }
    public function bill(){
    	return $this->hasManyThrough('App\Bill','App\BillDetail','id_product','id');
    }





    public static function Select_Product()
    {
      $pro = DB::table('products')->select('id','name');
      return $pro;
    }
    //Tất cả sản phẩm cùng loại cha
    public static function All_Product_ById($id)
    {
      $type=DB::table('category')
                  ->where('category.id',$id)
                  ->join('category as bang','category.id','=','bang.type_cha')
                  ->select()->get();
      $newPro= array();
      foreach ($type as $loaicha)
      {
        $newpro = DB::table('products')->select()->where([['id_type',$loaicha->id],['status',0]])->get();
        $newPro[$loaicha->id]=$newpro;
      }
            return $newPro;
    }
    // lấy sản phẩm theo loại cha và theo loại nội thất, ngoại thất
    public static function Show_Product_By_TypeCha($id, $type)
    {

      $typepro=DB::table('category')
                  ->where('category.id',$id)
                  ->join('category as bang','category.id','=','bang.type_cha')
                  ->select()->get();
      $Pro= array();
      foreach ($typepro as $loaicha)
      {
        $pro = DB::table('products')->where([['id_type',$loaicha->id],['type',$type],['status',0]])->get();
        $Pro[$loaicha->id]=$pro;
      }
      return $Pro;
    }

    //lấy sản phẩm theo loại con
    public static function Product_By_Id_Type($id)
    {
      $product = DB::table('products')->where([['id_type',$id],['export_product.status',0]])
                      ->join('export_product','products.id','=','export_product.id_product')
                      ->select('export_product.id as idsize','products.id','products.id_type','products.type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price');        
      return $product;
    }
    //lấy sản phảm theo loại sản phẩm: ngoại thất, nội thất
    public static function Show_Product_By_Type($id, $type)
    {
      $product = DB::table('products')->where([['id_type',$id],['type',$type],['status',0]]);
      return $product;
    }
    
    //Tìm sản phẩm chi tiết
    public static function Find_Product_By_Id($id) 
    {
        $product=DB::table('products')
                    ->where('products.id','=',$id)
                    ->join('export_product','products.id','=','export_product.id_product')
                    ->select('export_product.id as idsize','products.id','products.id_type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price','export_product.status');
            
        return $product;
    }

    
    //Sản phẩm mới
    public static function New_Product()
    {
      $day= Carbon::now()->subDays(5);
      $product=DB::table('products')->where('products.status',0)
                        ->join('category','products.id_type','=','category.id')
                        ->whereDate('products.created_at','>',$day)
                        ->select('category.type_cha','products.id','products.name', 
                                 'products.image');
      return $product;
    }
    //sản phẩm xem nhiều
    public static function Best_View_Product()
    {
      $product=DB::table('products')
                        ->where('view','>',10)
                        ->select();
      return $product;
    }





      //hiện tất cả các sản phẩm trang Admin
    public static function Show_Product_All(){
            $product=DB::table('products')
                        ->where('export_product.status',0)
                        ->join('category','products.id_type','=','category.id')
                        ->join('export_product','products.id','=','export_product.id_product')
                        
                    ->select('category.name as type_name','export_product.id as idsize','products.id','products.id_type','products.type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price');
        return $product;
    }

    //update sản phẩm trong admin
    public static function Edit_Product($id, $name, $category, $desc, $type, $image){
            $pro=DB::table('products')->where('id','=',$id)->update(['name'=>$name,'id_type'=>$category, 'description'=>$desc,'type'=>$type,'image'=>$image]);
            return $pro; 
    }
    public static function Insert_Product($name, $category, $desc, $type, $image){
              $id=DB::table('products')->insertGetId(['name'=>$name,'id_type'=>$category,'description'=>$desc,'type'=>$type,'image'=>$image]);
              return $id;
    }
    public static function Delete_Product($id){
          $pro=DB::table('products')->where('id','=',$id)->update(['status'=>1]);
          return $pro;
    }
    //lấy tất cả tên sản phẩm, id cho vào các trang edit
    public static function Product_Info_By_Id($id,$idsize)
    {
      $product=DB::table('products')
                  ->where('products.id',$id)
                  ->join('export_product','products.id','=','export_product.id_product')
                  ->where('export_product.id',$idsize)
                  ->select('products.id','products.name','products.image','products.description','products.id_type', 'products.type','export_product.size','export_product.export_price','export_product.id as idsize');
      return $product;
    }
  
    public static function Count_All_Product()
    {
        $pro = DB::table('products')->where('status',0)->count();
        return $pro;
    }
    public static function Count_View_Product()
    {
        $pro = DB::table('products')->sum('view');
        return $pro;
    }
  
}
