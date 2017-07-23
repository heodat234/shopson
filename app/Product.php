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
        $newpro = DB::table('products')->select()->where('id_type',$loaicha->id)->get();
        $newPro[$loaicha->id]=$newpro;
      }
            return $newPro;
    }
    //lấy sản phẩm thoe loại con
    public static function Product_By_Id_Type($id)
    {
      $product = DB::table('products')->where('id_type',$id);
      return $product;
    }
    //lấy sản phảm theo loại sản phẩm: ngoại thất, nội thất
    public static function Show_Product_By_Type($id, $type)
    {
      $product = DB::table('products')->where([['id_type',$id],['type',$type]]);
      return $product;
    }
    public static function Show_Product_By_TypeCha($id, $type)
    {

      $typepro=DB::table('category')
                  ->where('category.id',$id)
                  ->join('category as bang','category.id','=','bang.type_cha')
                  ->select()->get();
      $Pro= array();
      foreach ($typepro as $loaicha)
      {
        $pro = DB::table('products')->where([['id_type',$loaicha->id],['type',$type]])->get();
        $Pro[$loaicha->id]=$pro;
      }
      return $Pro;
    }
    //Tìm sản phẩm chi tiết
    public static function Find_Product_By_Id($id)
    {
        $product=DB::table('products')
                    ->where('products.id','=',$id)
                    ->join('export_product','products.id','=','export_product.id_product')
                    ->select('export_product.id as idsize','products.id','products.id_type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price');
                    // dd($product[0]->view);
            
        return $product;
    }
    //Sản phẩm mới
    public static function New_Product()
    {
      $day= Carbon::now()->subDays(5);
      $product=DB::table('products')
                        ->join('category','products.id_type','=','category.id')
                        ->whereDate('products.created_at','>',$day)
                        ->select('category.type_cha','products.id','products.name','products.unit_price', 
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
                        ->join('category','products.id_type','=','category.id')
                        ->select('category.name as type_name','products.id','products.name','products.unit_price', 
                                 'products.image','products.created_at',
                                 'products.updated_at','products.description');
        return $product;
    }
      public static function Edit_Product($id, $name, $type, $desc, $unit_price,$image){
            $pro=DB::table('products')->where('id','=',$id)->update(['name'=>$name,'id_type'=>$type, 'description'=>$desc,'unit_price'=>$unit_price,'image'=>$image]);
            return $pro; 
    }
    public static function Insert_Product($name, $type, $desc, $unit_price, $image){
              $id=DB::table('products')->insertGetId(['name'=>$name,'id_type'=>$type,'description'=>$desc,'unit_price'=>$unit_price,'image'=>$image]);
              return $id;
    }
    public static function Delete_Product($id){
          $pro=DB::table('products')->where('id','=',$id)->delete();
          return $pro;
    }
    //Tim sàn phẩm theo loại
    public static function Find_Product_By_Type($id){
        $product=DB::table('products')->where('id_type','=',$id);
        return $product;
    }

  //   public static function hotProduct()// tim san pham SAT noi bat
  //   {
  //   	$hotPro = DB::table('products')
  //   				->where('view','>','9');
  //           return $hotPro;

  //   }
  
  
  //   //Xóa sản phẩm theo id
  //   public static function Find_Product_By_Id($id){
  //       $product=DB::table('products')->where('id','=',$id)->delete();
  //       return $product;
  //   }
  //   //Các sản phẩm có lượng view nhiều nhất
  //   public static function MostViewProduct(){
  //       $product=array();
  //       $product_view=DB::table('products')->select()->orderBy('view','DESC')->limit(5)->get();
  //       $total_view=DB::table('products')->sum('view');
  //       $product[0]=$product_view;
  //       $product[1]=$total_view;
  //       return $product;
  //   }

  

  //     public static function findProductBestSale() // tim san pham ban chay
  //       {
  //           $bestsale = DB::table('bill_detail')->join('products','bill_detail.id_product','=','products.id')
  //                           ->select(DB::raw('sum(quantity) as quan'),'products.id','products.name','products.unit_price','products.promotion_price','products.image')
  //                           ->groupBy('products.name','products.id','products.unit_price','products.promotion_price','products.image')
  //                           ->orderBy('quantity','DESC')
  //                           ->limit(2);

  //           return $bestsale;
  //       }
  //   public static function findOneProduct($id)
  //   {
  //       $productcart = DB::table('products')
  //                   ->where('products.id','=',$id)
  //                   ->first();
  //       return $productcart;

  //   }

  //   public static function findProductPromotion()
  //   {
  //       $products = DB::table('products')->where('promotion_price','>','0')
  //                                       ->limit(8);
  //       return $products;
  //   }
}
